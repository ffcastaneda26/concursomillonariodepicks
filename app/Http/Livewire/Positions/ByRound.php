<?php

namespace App\Http\Livewire\Positions;

use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ByRound extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use FuncionesGenerales;

    protected $listeners = ['receive_round'];

    public $tie_breaker_game_played = false;
    public $my_position;
    public function mount(){
        $this->manage_title = 'Posiciones x Jornada';
        $this->view_table   = null;
        $this->view_list    = null;
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round =$this->current_round;
        $this->receive_round($this->current_round );
        $this->create_positions_to_user_with_role();
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){
        $this->tie_breaker_game_played = $this->selected_round->get_last_game_round()->has_result();
        if(Auth::user()->hasRole('participante')){
            $this->my_position = $this->selected_round->positions()->where('user_id',Auth::user()->id)->orderby('position')->first();
        }

        return view('livewire.positions.round.index', [
            'records' => $this->selected_round->positions()->orderby('position')->paginate(40),
        ]);
    }


    /*+-----------------+
      | Recibe Jornada  |
      +-----------------+
    */
    public function receive_round(Round $round){
        if($round){
            $this->selected_round = $round;
        }
    }
}


