<?php

namespace App\Http\Livewire\Positions;

use App\Http\Livewire\Traits\CrudTrait;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\GeneralPosition;
use Illuminate\Support\Facades\Auth;

class General extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use FuncionesGenerales;
    use CrudTrait;

    public $my_position;
    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){

        $positions = GeneralPosition::orderby('position')
                                    ->paginate($this->pagination);
       if(Auth::user()->hasRole('participante')){
            $this->my_position = GeneralPosition::where('user_id',Auth::user()->id)->first();
       }
        return view('livewire.positions.general.index', [
            'records' => $positions,
        ]);
    }

}


