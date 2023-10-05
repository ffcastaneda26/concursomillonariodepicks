<?php

namespace App\Http\Livewire;

use App\Models\Game;
use Livewire\Component;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;

class QualifyGames extends Component
{
    use CrudTrait;
    use FuncionesGenerales;


    public function render()
    {

        $this->qualify_all_picks();
        $this->update_acumulated_positions();
        return view('livewire.games.qualify-games');
    }

}
