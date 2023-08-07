<?php

namespace App\Http\Livewire;

use App\Models\Round;
use Livewire\Component;
use App\Http\Livewire\Traits\CrudTrait;

class SelectRound extends Component
{

    public function render()
    {
        return view('livewire.rounds.select-round', [
            'rounds' => Round::orderby('id')->get(),
        ]);
    }
}
