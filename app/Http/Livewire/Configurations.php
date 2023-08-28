<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use App\Models\Configuration;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Configurations extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use FuncionesGenerales;


    protected $rules = [
        'main_record.website_name'                  => 'required|min:3|max:150|unique:configuration,website_name',
        'main_record.website_url'                   => 'required|min:3|max:150|unique:configuration,website_url',
        'main_record.email'                         => 'required|email',
        'main_record.score_picks'                   => 'nullable',
        'main_record.minuts_before_picks'           => 'required|numeric',
        'main_record.allow_tie'                     => 'nullable',
        'main_record.create_mssing_picks'           => 'nullable',
        'main_record.require_payment_to_continue'   => 'nullable',
        'main_record.require_data_user_to_continue' => 'nullable',
        'main_record.assig_role_to_user'            => 'nullable',
        'main_record.add_user_to_stripe'            => 'nullable',
        'main_record.use_team_to_tie_breaker'       => 'nullable',
    ];

    public $configuration;


    public $score_picks                     = false;
    public $allow_tie                       = false;
    public $create_mssing_picks             = false;
    public $require_payment_to_continue     = false;
    public $require_data_user_to_continue   = false;
    public $assig_role_to_user              = false;
    public $add_user_to_stripe              = false;
    public $use_team_to_tie_breaker         = false;



    public function mount(){
        $this->manage_title = 'Configuración General';
        $this->view_search  = null;
        $this->view_form    = 'livewire.configurations.form';
        $this->view_table   = 'livewire.configurations.table';
        $this->view_list    = 'livewire.configurations.list';
        $this->main_record  = new Configuration();
        $this->allow_create = !Configuration::all()->count();
        $this->modal_size   = 'modal-lg';
        $this->read_teams();
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
        $this->main_record->require_payment_to_continue = $this->require_payment_to_continue ? 1 : 0;
        $this->main_record->require_data_user_to_continue = $this->require_data_user_to_continue ? 1 : 0;
        $this->main_record->assig_role_to_user = $this->assig_role_to_user ? 1 : 0;
        $this->main_record->add_user_to_stripe = $this->add_user_to_stripe ? 1 : 0;
        $this->main_record->use_team_to_tie_breaker = $this->use_team_to_tie_breaker ? 1 : 0;

        if(!$this->use_team_to_tie_breaker){
            $this->main_record->team_id = 0;
        }else{
            if($this->team_id){
                $this->main_record->team_id = $this->team_id;
            }
        }

        $this->close_store('Configuración');
    }

    /*+------------------------------+
    | Lee Registro Editar o Borar  |
    +------------------------------+
    */

    public function edit(Configuration $record){
        $this->main_record                  = $record;
        $this->record_id                    = $record->id;
        $this->score_picks                  = $record->score_picks;
        $this->allow_tie                    = $record->allow_tie;
        $this->create_mssing_picks          = $record->create_mssing_picks;
        $this->require_payment_to_continue  = $record->require_payment_to_continue;
        $this->require_data_user_to_continue= $record->require_data_user_to_continue;
        $this->assig_role_to_user           = $record->assign_role_to_user;
        $this->add_user_to_stripe           = $record->add_user_to_stripe;
        $this->use_team_to_tie_breaker      = $record->use_team_to_tie_breaker;
        $this->team_id                      = $record->team_id;
        $this->openModal();
    }

}
