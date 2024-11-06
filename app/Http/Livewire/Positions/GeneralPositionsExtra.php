<?php

namespace App\Http\Livewire\Positions;

use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use App\Models\Round;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class GeneralPositionsExtra extends Component
{
    USE AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use FuncionesGenerales;


     public $my_position;
    public $roundsIds=[];
    public function mount(){
        $this->read_configuration();
        $this->rounds = Round::wherehas('games',function($query){
            $query->whereNotNull('local_points')
                  ->WhereNotNull('visit_points');
        })
        ->where('id','>=',$this->configuration->round_to_extra_context)
        ->get();

        $this->roundsIds = Round::select('id')->wherehas('games',function($query){
                    $query->whereNotNull('local_points')
                        ->WhereNotNull('visit_points');
                })
                ->where('id','>=',$this->configuration->round_to_extra_context)
                ->get()->toArray();
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */
    public function render(){

        if(Auth::user()->hasRole('participante')){
            $this->my_position = true;
       }

        return view('livewire.positions.general.general-positions-extra', [
            'records' => User::role('participante')
                            ->select('users.id','users.name','general_positions.position_extra_contest','general_positions.hits_extra_contest as total')
                            ->Join('positions', 'positions.user_id', '=', 'users.id')
                            ->Join('general_positions', 'general_positions.user_id', '=', 'users.id')
                            ->where('users.active','1')
                            ->where('positions.round_id','>=',$this->configuration->round_to_extra_context)
                            ->groupBy('users.id','general_positions.position_extra_contest','total')
                            ->orderby('general_positions.position_extra_contest')
                            ->paginate(40),
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
