<?php

namespace App\Http\Livewire\Positions;

use App\Models\User;

use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\GeneralPosition;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class GeneralPositions extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use FuncionesGenerales;

    public $users_with_picks_round= null;
    public $cols_show= [];
    public $my_position;
    public $roundsIds=[];
    public function mount(){
        $this->rounds = Round::wherehas('games',function($query){
            $query->whereNotNull('local_points')
                  ->WhereNotNull('visit_points');
        })->get();

        $this->roundsIds = Round::select('id')->wherehas('games',function($query){
                    $query->whereNotNull('local_points')
                        ->WhereNotNull('visit_points');
                })->get()->toArray();
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */
    public function render(){

        if(Auth::user()->hasRole('participante')){
            $this->my_position = true;
       }

        return view('livewire.positions.general.general_position', [
            'records' => User::role('participante')
                            ->select('users.id','users.name','general_positions.position')
                            ->Join('positions', 'positions.user_id', '=', 'users.id')
                            ->Join('general_positions', 'general_positions.user_id', '=', 'users.id')
                            ->where('users.active','1')
                            ->groupBy('users.id','general_positions.position')
                            ->orderby('general_positions.position')
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

}
