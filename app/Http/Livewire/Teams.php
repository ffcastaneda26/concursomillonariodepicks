<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;
use App\Models\Distrito;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Teams extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;

    protected $listeners = ['destroy'];
    protected $rules = [
        'main_record.name' => 'required|min:3|max:50|unique:teams,name',
        'main_record.alias' => 'required|min:3|max:20|unique:teams,alias',
        'main_record.short' => 'required|min:3|max:3|unique:teams,short',
        'main_record.logo' => 'nullable',

    ];

    public function mount(){
        $this->manage_title = 'Gestionar Equipos';
        $this->search_label = 'Equipo';
        $this->view_form    = 'livewire.teams.form';
        $this->view_table   = 'livewire.teams.table';
        $this->view_list    = 'livewire.teams.list';
        $this->main_record  = new Team();
        $this->sort         = 'name';
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){
        $this->create_button_label = $this->main_record->id ?  'Actualizar Equipo' :  ' Crear Equipo';

        return view('livewire.index', [
            'records' => Team::General($this->search)->orderby($this->sort,$this->direction)->paginate($this->pagination),
        ]);
    }

    public function resetInputFields()
    {
        $this->main_record = new Team();
        $this->reset('logotipo');
        $this->resetErrorBag();

    }

    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */

    public function store(){
        $this->rules['main_record.name'] = $this->main_record->id ? "required|min:3|max:50|unique:teams,name,{$this->main_record->id}"
                                                                  : 'required|min:3|max:50|unique:teams,name';
        $this->rules['main_record.alias'] = $this->main_record->id ? "required|min:3|max:20|unique:teams,alias,{$this->main_record->id}"
                                                                  : 'required|min:3|max:20|unique:teams,alias';
        $this->rules['main_record.short'] = $this->main_record->id ? "required|min:3|max:3|unique:teams,short,{$this->main_record->id}"
                                                                  : 'required|min:3|max:3|unique:teams,short';
        $this->validate();


        if($this->logotipo){
            if($this->imagen_anterior){
                Storage::delete($this->imagen_anterior);
            }
            $nombre_archivo = 'logo_' . str_pad($this->main_record->id, 3, '0', STR_PAD_LEFT) . '_'.$this->logotipo->getClientOriginalName();
            $Image = $this->logotipo->storeAs('public/teams',$nombre_archivo);
            $this->main_record->logo = $Image;
        }

        $this->close_store('Equipo');
    }

    /*+------------------------------+
    | Lee Registro Editar o Borar  |
    +------------------------------+
    */

    public function edit(Team $record){
        $this->main_record      = $record;
        $this->record_id        = $record->id;
        $this->imagen_anterior = $this->main_record->logotipo;
        $this->openModal();
    }

    /*+------------------------------+
      | Elimina Registro             |
      +------------------------------+
    */
    public function destroy(Team $record)
    {

        $this->delete_record($record, __('Equipo Eliminado Satisfactoriamente!!'));
    }
}
