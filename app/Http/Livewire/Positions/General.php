<?php

namespace App\Http\Livewire\Positions;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class General extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use FuncionesGenerales;

    public function mount(){
        $this->rounds = $this->read_rounds();
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){


        return view('livewire.positions.general.index', [
            'records' => $this->read_records_to_general_positions(),
        ]);
    }

}


