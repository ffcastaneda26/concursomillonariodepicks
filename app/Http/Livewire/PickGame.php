<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PickGame extends Component
{
    public $game;

    public function mount($game){

    }

    public function render()
    {
        return view('livewire.pick-game');
    }


}
