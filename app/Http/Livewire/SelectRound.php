<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Round;
use Livewire\Component;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;

class SelectRound extends Component
{
    use CrudTrait;
    use FuncionesGenerales;

    public $show_all = true;

    public function mount($show_all=null){

        $this->rounds = $this->read_rounds();
        $round = new Round();
        $this->current_round = $round->read_current_round();
        if($show_all && is_null($show_all)){
            $this->show_all = $this->current_round;
        }
    }

    public function render()
    {
        if(!$this->selected_round){
            $this->selected_round = $this->current_round;
        }


        $this->emit('receive_round',$this->selected_round->id);
        return view('livewire.rounds.select-round');
    }


}
