<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Bet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Bets extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;

    public $name;
    protected $listeners = ['destroy'];
    protected $rules = [
        'main_record.name' => 'required|min:3|max:50|unique:bets,name',
    ];

    public function mount(){
        $this->manage_title = 'Gestionar Tipos de Apuesta';
        $this->search_label = 'Apuesta';
        $this->view_form    = 'livewire.bets.form';
        $this->view_table   = 'livewire.bets.table';
        $this->view_list    = 'livewire.bets.list';
        $this->main_record  = new Bet();
        $this->sort         = 'name';
        $this->view_search = null;
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){
        $this->create_button_label = $this->main_record->id ?  'Actualizar Apuesta' :  ' Crear Apuesta';

        return view('livewire.index', [
            'records' => Bet::General($this->search)->orderby($this->sort,$this->direction)->paginate($this->pagination),
        ]);
    }

    public function resetInputFields()
    {
        $this->main_record = new Bet();
        $this->reset('name');
        $this->resetErrorBag();

    }

    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */

    public function store(){
        $this->rules['main_record.name'] = $this->main_record->id ? "required|min:3|max:50|unique:bets,name,{$this->main_record->id}"
                                                                  : 'required|min:3|max:50|unique:bets,name';
         $this->validate();

        $this->close_store('Apuesta');
    }

    /*+------------------------------+
    | Lee Registro Editar o Borar  |
    +------------------------------+
    */

    public function edit(Bet $record){
        $this->main_record      = $record;
        $this->record_id        = $record->id;
        $this->openModal();
    }

    /*+------------------------------+
      | Elimina Registro             |
      +------------------------------+
    */
    public function destroy(Bet $record)
    {

        $this->delete_record($record, __('Apuesta Eliminada Satisfactoriamente!!'));
    }
}
