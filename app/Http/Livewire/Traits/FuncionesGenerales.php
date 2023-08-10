<?php

namespace App\Http\Livewire\Traits;

use App\Models\Round;
use App\Models\Configuration;
use App\Models\Game;
use App\Models\Pick;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Auth;


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
    public $configuration = null;



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


    public function games_without_picks($user_id,$round_id){

        if(!$user_id){
            $user_id = Auth::user()->id;
        }

        // $rounds_missing = Round::select('id')->where('id','>=',$round_id)->get()->toArray();
        // $sql = "SELECT * ";
        // $sql.= "FROM games ";
        // $sql.= " WHERE id NOT IN ";
        // $sql.= "(SELECT game_id FROM picks WHERE user_id=" . $user_id . " AND round_id >=" . $round_id . ") ORDER BY id";
        // $records = DB::select($sql);



        $games = game::whereDoesntHave('picks', function (Builder $query) {
            $query->where('user_id',Auth::user()->id);
            })->where('round_id','>=',$round_id)->get();


        foreach($games as $game){
            if($game->allow_pick()){
                $winner = mt_rand(1,2);
                $new_pick = Pick::create([
                    'user_id'   => $user_id,
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
                }
                $new_pick->save();
            }
        }

    }

    // public function is_last_game(Round $round,$game_id){
    //     return $round->games->last()->id == $game_id;
    // }
}
