<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;
use App\Models\Distrito;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use App\Models\Configuration;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Configurations extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;


    protected $rules = [
        'main_record.website_name'  => 'required|min:3|max:150|unique:configuration,website_name',
        'main_record.website_url'   => 'required|min:3|max:150|unique:configuration,website_url',
        'main_record.email'         => 'required|email',
        'main_record.score_picks'   => 'nullable',
        'main_record.minuts_before_picks'   => 'required|numeric',
        'main_record.allow_tie'   => 'nullable',
        'main_record.create_mssing_picks'   => 'nullable',
    ];

    public $configuration;

    public $score_picks = false;
    public $allow_tie = false;
    public $create_mssing_picks = false;

    public function mount(){
        $this->manage_title = 'Configuración General';
        $this->view_search  = null;
        $this->view_form    = 'livewire.configurations.form';
        $this->view_table   = 'livewire.configurations.table';
        $this->view_list    = 'livewire.configurations.list';
        $this->main_record  = new Configuration();
        $this->allow_create = !Configuration::all()->count();
        $this->modal_size   = 'modal-lg';
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){
        $this->create_button_label = $this->main_record->id ?  'Actualizar Configuración' :  ' Crear Configuración';
        $this->configuration = Configuration::first();
        return view('livewire.configurations.index');
    }

    public function resetInputFields()
    {
        $this->main_record = new Configuration();
        $this->resetErrorBag();
    }

    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */

    public function store(){
        $this->rules['main_record.website_name'] = $this->main_record->id ? "required|min:10|max:150|unique:configuration,website_name,{$this->main_record->id}"
                                                                          : 'required|min:10|max:150|unique:configuration,website_name';
        $this->rules['main_record.website_url'] = $this->main_record->id  ? "required|min:10|max:150|unique:configuration,website_url,{$this->main_record->id}"
                                                                          : 'required|min:10|max:150|unique:configuration,website_url';

        $this->validate();

        $this->main_record->score_picks = $this->score_picks ? 1 : 0;
        $this->main_record->allow_tie = $this->allow_tie ? 1 : 0;
        $this->main_record->create_mssing_picks = $this->create_mssing_picks ? 1 : 0;
        $this->close_store('Configuración');
    }

    /*+------------------------------+
    | Lee Registro Editar o Borar  |
    +------------------------------+
    */

    public function edit(Configuration $record){
        $this->main_record      = $record;
        $this->record_id        = $record->id;
        $this->score_picks = $record->score_picks;
        $this->allow_tie = $record->allow_tie;
        $this->create_mssing_picks = $record->create_mssing_picks;
        $this->openModal();
    }

}
