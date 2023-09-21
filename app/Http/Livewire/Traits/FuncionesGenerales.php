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
use Spatie\Permission\Models\Role;

trait FuncionesGenerales
{
    // Variables
    public $selected_round  = null;
    public $round_games     = null;
    public $current_round   = null;
    public $rounds          = null;
    public $roles           = null;
    public $teams           = null;
    public $team            = null;
    public $round_id        = null;
    public $role_id         = null;
    public $users           = null;
    public $user_id         = null;
    public $user            = null;

    public $team_id         = null;
    public $game_instance   = null;
    public $configuration   = null;
    public $round_positions = null;
    public $round_picks     = null;



    // Lee configuración
    public function read_configuration(){
        $this->configuration = Configuration::first();

    }
    // Lee Roles
    public function read_roles(){
        return $this->roles = Role::orderby('name')->get();
    }

    // Lee usuarios con algún rol
    public function read_users_role($role='participante')
    {
        return $this->users = User::role($role)->select('id','name')->get();
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
        return $this->teams = Team::orderby('id')->get();
    }


    // Crea pronósticos faltantes del usuario
    public function create_missing_picks_to_user(){
        $games = game::whereDoesntHave('picks', function (Builder $query) {
            $query->where('user_id',Auth::user()->id);
            })->get();

        foreach($games as $game){
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

    // Crea registro en tabla de posiciones
    public function create_missing_positions_to_user(){

        $rounds = Round::whereDoesntHave('positions', function (Builder $query) {
            $query->where('user_id',Auth::user()->id);
            })->get();

        foreach($rounds as $round){
            if(!Auth::user()->has_position_record_round($round->id)){
                $this->create_position_record_round_user($round->id);
            }
        }

    }

    // Crea registro de POSICIONES para todos los usuarios con rol participante
    public function create_positions_to_user_with_role($role = 'participante'){
        $users = User::role($role)->get();
        foreach($users as $user){
            $rounds = Round::whereDoesntHave('positions', function (Builder $query) use($user) {
                $query->where('user_id',$user->id);
                })->get();

            foreach($rounds as $round){
                if(!$user->has_position_record_round($round->id)){
                    $this->create_position_record_round_user($round->id,$user->id);
                }
            }
        }
    }

    public function create_missing_picks_user(User $user){
        $games = game::whereDoesntHave('picks', function (Builder $query) use ($user) {
            $query->where('user_id',$user->id);
            })->get();

        foreach($games as $game){
            $winner = mt_rand(1,2);
            $new_pick = Pick::create([
                'user_id'   => $user->id,
                'game_id'   => $game->id,
                'winner'    => $winner
                ]);

            $points = mt_rand(0,47);
            if($game->is_last_game_round()){
                if($winner == 1){
                    $new_pick->local_points = $points;
                    $new_pick->visit_points = 0;
                }else{
                    $new_pick->local_points = 0;
                    $new_pick->visit_points = $points;
                }
                $new_pick->total_points = $points;
            }
            $new_pick->save();
        }
    }

    // Inicializa positions
    private function inicialize_positions(Game $game){
        $sql = "UPDATE positions ";
		$sql.="SET dif_winner_points=NULL,";
        $sql.="error_abs_local_visita=NULL,";
        $sql.="marcador_total=NULL,";
        $sql.="hit_last_game=0,";
        $sql.="hit_last_game=NULL ";
        $sql.="WHERE round_id=" . $game->round_id;
        DB::update($sql);
    }

    private function inicialize_picks(Game $game){
        $sql = "UPDATE picks ";
		$sql.="SET dif_points_local=NULL,";
        $sql.="dif_points_visit=NULL,";
        $sql.="error_abs_local_visita=NULL,";
        $sql.="hit_local=0,";
        $sql.="hit_visit=0,";
        $sql.="hit=0,";
        $sql.="hit_last_game=0,";
        $sql.="dif_points_winner=NULL,";
        $sql.="marcador_total=NULL ";
        $sql.="WHERE game_id=" . $game->id;
        DB::update($sql);
    }
    // Actualia criterios de desempate
    public function update_tie_breaker(Game $game){

        $this->inicialize_positions($game); // Inicializa campos de desempate en tabla POSITIONS de la jornada;
        $this->inicialize_picks($game);      // Inicializa PRONOSTICOS del juego

        // Actualiza PRONOSTICOS del Juego
        $marcador_total = $game->local_points + $game->visit_points ;
        $sql = "UPDATE picks pic,games ga ";
		$sql.="SET ";
		$sql.="pic.dif_points_local=abs(".$game->local_points."-pic.local_points),";
		$sql.="pic.dif_points_visit= abs(".$game->visit_points ."-pic.visit_points),";
		$sql.="pic.error_abs_local_visita= abs(abs(". $game->visit_points . "-pic.visit_points)+abs(". $game->local_points."-pic.local_points)),";
		$sql.="hit_local= CASE WHEN pic.local_points=". $game->local_points . " THEN 1 ELSE 0  END,";
		$sql.="hit_visit= CASE WHEN pic.visit_points=". $game->visit_points  ." THEN 1 ELSE 0  END,";
		$sql.="hit= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END,";
        $sql.="hit_last_game= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END,";
		$sql.="dif_points_winner= CASE WHEN (" . $game->local_points . ">". $game->visit_points  . ") THEN abs(pic.local_points - " . $game->local_points . ") ELSE abs(pic.visit_points - " . $game->visit_points  . ")  END,";
		$sql.="pic.marcador_total=abs(" . $marcador_total . "-(pic.local_points + pic.visit_points)) ";
		$sql.="WHERE ga.id = pic.game_id ";
		$sql.="  AND ga.id=" . $game->id;
        return DB::update($sql);
    }

    // Actualiza si acertó el último partido
    public function update_hit_last_game(Game $game){
        $sql = "UPDATE picks pic,games ga ";
		$sql.="SET ";
		$sql.="hit_last_game= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END ";
		$sql.="WHERE ga.id = pic.game_id ";
        $sql.="  AND ga.id = " . $game->id;
        DB::update($sql);
    }
    // // Califica los pronósticos
    public function qualify_picks(Game $game){
        $sql = "UPDATE picks pic,games ga ";
		$sql.="SET ";
		$sql.="hit= CASE WHEN pic.winner=ga.winner THEN 1 ELSE 0 END ";
		$sql.="WHERE ga.id = pic.game_id ";
        $sql.="  AND ga.id = " . $game->id;
        DB::update($sql);
    }

    /**+------------------------------------------------------------+
       | Crea registro en tabla de posicinoes: POSITOINS            |
       | Recibe:                                                    |
       |    - Jornada                                               |
       |    - Usuario_id: Si no viene asume el usuario conectado    |
       +------------------------------------------------------------+
     */
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
    public function update_total_hits(Round $round){

        $cursor_hits = User::role('participante')
                    ->select('users.id as user_id',
                                DB::raw('SUM(picks.hit) as hits'),)
                    ->Join('picks', 'picks.user_id', '=', 'users.id')
                    ->Join('games', 'picks.game_id', '=', 'games.id')
                    ->where('games.round_id',$round->id)
                    ->where('users.active',1)
                    ->where('picks.selected',1)
                    ->groupBy('users.id')
                    ->get();

        if(!empty($cursor_hits)){
            foreach($cursor_hits as $hit){
                $user = User::findOrFail($hit->user_id);
                if(!$user->has_position_record_round($round->id)){
                   $position_record =  $this->create_position_record_round_user($round->id,$user->id);
                }

                $position_record = Position::where('user_id',$user->id)
                                            ->where('round_id',$round->id)
                                            ->first();

                $position_record->hits                      = $hit->hits;
                $position_record->save();
            }
        }



    }

        // Crea puntos x jornada
        public function update_tie_brake(Round $round){

            $cursor_hits = User::role('participante')
                        ->select('users.id as user_id',
                                    DB::raw('SUM(picks.error_abs_local_visita) as error_abs_local_visita'),
                                    DB::raw('SUM(picks.dif_points_winner) as dif_winner_points'),
                                    DB::raw('SUM(picks.marcador_total) as marcador_total'),
                                    DB::raw('SUM(picks.hit_last_game) as hit_last_game'),)
                        ->Join('picks', 'picks.user_id', '=', 'users.id')
                        ->Join('games', 'picks.game_id', '=', 'games.id')
                        ->where('games.round_id',$round->id)
                        ->where('users.active',1)
                        ->groupBy('users.id')
                        ->get();

            if(!empty($cursor_hits)){
                foreach($cursor_hits as $hit){
                    $user = User::findOrFail($hit->user_id);
                    if(!$user->has_position_record_round($round->id)){
                       $position_record =  $this->create_position_record_round_user($round->id,$user->id);
                    }

                    $position_record = Position::where('user_id',$user->id)
                                                ->where('round_id',$round->id)
                                                ->first();

                    $position_record->hit_last_game             = $hit->hit_last_game;
                    $position_record->error_abs_local_visita    = $hit->error_abs_local_visita;
                    $position_record->dif_winner_points         = $hit->dif_winner_points;
                    $position_record->marcador_total            = $hit->marcador_total;
                    $position_record->save();
                }
            }



        }

    // Asigna posición a tabla de POSITIONS

    public function update_positions(Round $round){

        $this->update_positions_to_null($round);

        $positions = Position::orderbyDesc('hits')
                            ->orderbyDesc('hit_last_game')
                            ->orderby('error_abs_local_visita')
                            ->orderby('dif_winner_points')
                            ->orderby('marcador_total')
                            ->orderby('created_at')
                            ->where('round_id',$round->id)
                            ->get();

        $i=1;
        foreach($positions as $position){
            $position->position = $i++;
            $position->save();
        }

    }

    // Actualiza posiciones a NULL
    public function update_positions_to_null(Round $round){
        $sql = "UPDATE positions ";
		$sql.="SET position=NULL ";
        $sql.="WHERE round_id=" . $round->id;
        DB::update($sql);
    }

    // Lee y calcula para poner la tabla General de Posiciones

    public function read_records_to_general_positions(){
        $positions = User::role('participante')
                        ->select('users.name as name',
                                DB::raw('SUM(positions.hits) as hits'),
                                DB::raw('SUM(positions.hit_last_game)    as hit_last_games'),
                                DB::raw('SUM(positions.error_abs_local_visita) as error_abs_local_visita'))
            ->Join('positions', 'positions.user_id', '=', 'users.id')
            ->where('users.active','1')
            ->groupBy('users.id')
            ->orderbyDesc('hits')
            ->orderbyDesc('hit_last_games')
            ->orderby('error_abs_local_visita')
            ->paginate(15);

        return $positions;
    }
}
