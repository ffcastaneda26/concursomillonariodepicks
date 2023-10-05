<?php

namespace App\Http\Livewire;

use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BkResults extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;
    use FuncionesGenerales;

    protected $listeners = ['receive_round'];

    public $users_with_picks_round= null;
    public $cols_show= [];

    public function mount(){
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round =$this->current_round;
        $this->receive_round($this->selected_round );
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */
    public function render(){
        // $this->read_picks_by_user($this->selected_round);
        // return view('livewire.results.index');
        return view('livewire.results.index', [
            'records' => User::role('participante')
                            ->select('users.*')
                            ->Join('picks', 'picks.user_id', '=', 'users.id')
                            ->Join('games', 'picks.game_id', '=', 'games.id')
                            ->where('games.round_id',$this->selected_round->id)
                            ->where('users.active','1')
                            ->groupBy('users.id')
                            ->paginate($this->pagination),
        ]);
    }


    /*+------------------------------------+
      | Recibe Jornada y selecciona juegos |
      +------------------------------------+
    */

    public function receive_round(Round $round){
        if($round){
            $this->selected_round = $round;
            $this->round_games  = $this->selected_round->games()->orderby('game_day')->orderby('game_time')->get();
        }
    }

    /*+-----------------------------------------------------+
      |             Integra Tabla de Pronóstios             |
      +--------+---------+-------------+---------+----------+
      | Nombre | Juego 1 | Juego 2.... | Juego N | Aciertos |
      +--------+---------+-------------+---------+----------+
    */

    private function read_picks_by_user(Round $round){
        // $this->users_with_picks_round = $this->read_users_picks_round($this->selected_round);
        // $tabla = collect();
        // $games_picks= [];
        // $logotipos  = [];
        // $aciertos   = [];
        // foreach($this->users_with_picks_round as $pick_user){
        //     $participante = $pick_user->name;
        //     $picks = $round->picks_user($pick_user->id)->get();

        //     $i=0;
        //     foreach($this->round_games as $game){

        //         foreach($picks as $pick){
        //             $col=null;
        //             if ($game->id == $pick->game_id){ // Es la columna del juego
        //                 $allow_pick = $game->allow_pick();
        //                 $has_result = $game->has_result();
        //                 $winner_pick= $pick->winner == 1 ? 'local' : 'visit';

        //                 if($allow_pick){
        //                     $col="Reloj";
        //                 }else{
        //                     if($has_result){
        //                         if($pick->winner == $game->winner){
        //                             $col = $winner_pick == 'local' ? 'hit_local' : 'hit_visit';
        //                             $aciertos[$i] = true;
        //                         }else{
        //                             $col = $winner_pick == 'local' ? 'local' : 'visit';
        //                             $aciertos[$i] = false;
        //                         }
        //                     }else{
        //                         $col = $winner_pick == 'local' ? 'local' : 'visit';
        //                         $aciertos[$i] = null;
        //                     }
        //                 }

        //                 $logotipos[$i] = $winner_pick == 'local' ? $game->local_team->logo
        //                                                          : $game->visit_team->logo;
        //                 $games_picks[$i] = $col;
        //                 break;
        //             }
        //         }
        //         $i++;
        //     }
        //     $tabla->push([
        //         'participante'  => $participante,
        //         'games'         => $games_picks,
        //         'logotipos'     => $logotipos,
        //         'aciertos'      => $aciertos,
        //     ]);
        // }
    }

    // private function read_users_picks_round(Round $round){
    //     return User::role('participante')
    //                 ->select('users.*')
    //                 ->Join('picks', 'picks.user_id', '=', 'users.id')
    //                 ->Join('games', 'picks.game_id', '=', 'games.id')
    //                 ->where('games.round_id',$round->id)
    //                 ->where('users.active','1')
    //                 ->groupBy('users.id')
    //                 ->get();
    // }
}
