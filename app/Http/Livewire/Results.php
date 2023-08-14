<?php

namespace App\Http\Livewire;

use App\Models\Game;
use App\Models\Pick;
use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Results extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;
    use FuncionesGenerales;

    protected $listeners = ['receive_round'];

    public $gamesids= array();


    public function mount(){
        $this->read_configuration();
        $this->rounds = $this->read_rounds();
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round =$this->current_round;
        $this->receive_round($this->current_round );
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */
    public function render(){
        return view('livewire.results.index');
    }

    /*+---------------+
      | Recibe Juegos |
      +---------------+
    */

    public function receive_round(Round $round){
        if($round){
            $this->reset('gamesids');
            $this->selected_round = $round;
            $this->gamesids[]   = $round->games()->select('id')->orderby('id')->get()->toArray();
            $this->round_games  = $round->games()->orderby('id')->get();
            $this->round_picks  = $round->picks()
                                        ->distinct('')
                                        ->orderby('user_id')
                                        ->get();

        }
    }


}





