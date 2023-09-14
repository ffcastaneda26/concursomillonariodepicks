<?php

namespace App\Http\Livewire\Positions;

use App\Models\Game;
use App\Models\Pick;
use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use App\Models\Position;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ByRound extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;
    use FuncionesGenerales;

    protected $listeners = ['receive_round'];


    public function mount(){
        $this->manage_title = 'Posiciones x Jornada';
        $this->view_table   = null;
        $this->view_list    = null;
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round =$this->current_round;
        $this->receive_round($this->current_round );
        // Genera las posiciones que falten de usuarios
        $this->create_positions_to_user_with_role();
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){
        return view('livewire.positions.round.index', [
            'records' => $this->selected_round->positions()->orderby('position')->paginate(10),
        ]);
    }


    /*+---------------+
      | Recibe Juegos |
      +---------------+
    */

    public function receive_round(Round $round){
        if($round){
            $this->selected_round = $round;
        }

    }
}


