<?php

namespace App\Http\Livewire;

use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;

class Rounds extends Component
{
    use WithPagination;
    public $rounds;

    public function render()
    {

        return view('livewire.rounds.index', [
            'records' => Round::paginate(5),
        ]);
    }
}
