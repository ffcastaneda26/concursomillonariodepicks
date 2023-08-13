<?php

namespace App\Http\Livewire\Traits;

use App\Models\Game;
use App\Models\Pick;
use App\Models\Team;
use App\Models\User;
use App\Models\Round;
use App\Models\Configuration;
use App\Models\Position;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


trait FuncionesGenerales
{
    // Variables
    public $selected_round  = null;
    public $round_games     = null;
    public $current_round   = null;
    public $rounds          = null;
    public $teams           = null;
    public $team            = null;
    public $round_id        = null;
    public $team_id         = null;
    public $game_instance   = null;
    public $configuration   = null;




    // Lee configuración
    public function read_configuration(){
        $this->configuration = Configuration::first();

    }


    // Lee jornadas
    public function read_rounds(){
        return $this->rounds = Round::orderby('id')->get();
    }

    // Lee jornada seleccionada
    public function select_round(Round $round){
        $this->reset('selected_round');
        if($round){
            $this->selected_round = $round;
        }else{
            $this->selected_round = $this->current_round;
        }
        $this->round_games = $this->selected_round->games;
    }


    // Lee equipos
    public function read_teams(){
        $this->teams = Team::orderby('id')->get();
    }


    // Crea pronósticos faltantes del usuario
    public function create_missing_picks_to_user($round_id){
        $games = game::whereDoesntHave('picks', function (Builder $query) {
            $query->where('user_id',Auth::user()->id);
            })->where('round_id','>=',$round_id)
              ->get();


        foreach($games as $game){
            if($game->allow_pick()){
                $winner = mt_rand(1,2);
                $new_pick = Pick::create([
                    'user_id'   => Auth::user()->id,
                    'game_id'   => $game->id,
                    'winner'    => $winner
                    ]);

                if($game->is_last_game_round()){
                    if($winner == 1){
                        $new_pick->local_points = 7;
                        $new_pick->visit_points = 0;
                    }else{
                        $new_pick->local_points = 0;
                        $new_pick->visit_points = 7;
                    }
                    $new_pick->total_points = 7;
                }
                $new_pick->save();

            }
        }

        // Si el usuario no tiene registro en tabla POSITIONS lo crea

        if(!Auth::user()->has_position_record_round($round_id)){

            $this->create_position_record_round_user($round_id);
        }

    }


    // Actualia criterios de desempate
    public function update_tie_breaker(Game $game){
        $dif_victoria = $game->local_points + $game->visit_points ;
        $sql = "UPDATE picks pic,games ga ";
		$sql.="SET ";
		$sql.="pic.dif_points_local=abs(".$game->local_points."-pic.local_points),";
		$sql.="pic.dif_points_visit= abs(".$game->visit_points ."-pic.visit_points),";
		$sql.="pic.dif_points_total= abs(abs(". $game->visit_points . "-pic.visit_points)+abs(". $game->local_points."-pic.local_points)),";
		$sql.="hit_local= CASE WHEN pic.local_points=". $game->local_points . " THEN 1 ELSE 0  END,";
		$sql.="hit_visit= CASE WHEN pic.visit_points=". $game->visit_points  ." THEN 1 ELSE 0  END,";
		$sql.="hit= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END,";
		$sql.="dif_points_winner= CASE WHEN (" . $game->local_points . ">". $game->visit_points  . ") THEN abs(pic.local_points - " . $game->local_points . ") ELSE abs(pic.visit_points - " . $game->visit_points  . ")  END,";
		$sql.="pic.dif_victory=abs(" . $dif_victoria . "-(pic.local_points + pic.visit_points)) ";
		$sql.="WHERE ga.id = pic.game_id ";
		$sql.="  AND ga.id=" . $game->id;

        return DB::update($sql);
    }

    // // Califica los pronósticos
    public function qualify_picks(Game $game){
        $sql = "UPDATE picks pic,games ga ";
		$sql.="SET ";
		$sql.="hit= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END ";
		$sql.="WHERE ga.id = pic.game_id ";
		$sql.="  AND ga.id=" . $game->id;

        DB::update($sql);
    }

    // Crea el registro en tabla POSITIONS recibiendo ronda y usuario si este es null asume usuario conectado
    public function create_position_record_round_user($round_id,$user_id=null){
        if(!$user_id){
            $user_id = Auth::user()->id;
        }
        $new_position_record = new Position();
        $new_position_record->round_id = $round_id;
        $new_position_record->user_id = $user_id;
        $new_position_record->save();
        return  $new_position_record;

    }

    // Crea puntos x jornada
    public function update_positions(Round $round){

        $hits = User::role('participante')
                    ->select('users.id as user_id','rounds.id as round_id',DB::raw('SUM(picks.hit) as hits'))
                    ->Join('picks', 'picks.user_id', '=', 'users.id')
                    ->Join('games', 'picks.game_id', '=', 'games.id')
                    ->Join('rounds', 'games.round_id', '=', 'rounds.id')
                    ->where('games.round_id',$round->id)
                    ->where('users.active','1')
                    ->groupBy('users.id')
                    ->groupBy('rounds.id')
                    ->get();

        if(!empty($hits)){

            foreach($hits as $hit){

                $user = User::findOrFail($hit->user_id);

                if(!$user->has_position_record_round($hit->round_id)){
                   $position_record =  $this->create_position_record_round_user($hit->round_id,$user->id);
                }



                $position_record = Position::where('user_id',$user->id)
                                            ->where('round_id',$hit->round_id)
                                            ->first();


                $position_record->hits = $hit->hits;
                $position_record->save();


            }
        }
    }
}
