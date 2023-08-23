<?php

namespace App\Http\Livewire;

use App\Models\Game;
use App\Models\User;
use App\Models\Round;
use App\Models\Entidad;
use Livewire\Component;
use App\Models\Municipio;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Traits\CrudTrait;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DataUsers extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;
    use FuncionesGenerales;

    protected $listeners = ['receive_round'];


    protected $rules = [
        'main_record.entidad_id'    => 'required|exists:entidades,id',
        'main_record.municipio_id'  => 'required|exists:municipios,id',
        'main_record.codpos'        => 'required|numeric',
        'ine_anverso'               => 'required|image|max:2048',
        'ine_reverso'               => 'required|image|max:2048',
    ];


    public $error_message;
    public $entidades   = null;
    public $entidad     = null;
    public $municipios  = null;

    public $municipio   = null;

    // Propiedades para recibir los datos
    public $entidad_id  = null;
    public $municipio_id= null;
    public $codpos      = null;
    public $ine_anverso =null;
    public $ine_reverso = null;


    public function mount(){
        $this->manage_title = 'Datos Complementarios';
        $this->search_label = null;
        $this->view_search  = null;
        $this->view_form    = 'livewire.games.form';
        $this->view_table   = 'livewire.games.table';
        $this->view_list    = 'livewire.games.list';
        $this->main_record  = Auth::user();
        $this->allow_create = true;


        if($this->main_record->entidad_id){
            $this->entidad_id = $this->main_record->entidad_id;
        }

        if($this->main_record->municipio_id){
            $this->municipio_id = $this->main_record->municipio_id;
        }

        if($this->main_record->cospos){
            $this->codpos = $this->main_record->cospos;
        }

        $this->lee_entidades();

    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){
        $this->create_button_label = $this->main_record->has_suplementary_data() ?  'Actualizar Datos' :  ' Crear Datos';
        return view('livewire.datausers.index');
    }


    /** Lee entidades */

    public function lee_entidades(){
        $this->entidades = Entidad::orderby('predeterminado','Desc')
                                    ->orderby('nombre')
                                    ->get();
        $this->lee_entidad();
    }


    /** Lee la entidad para que se puedan cargar los municipios */

    public function lee_entidad(){
        if($this->main_record->entidad_id){
            $this->entidad = Entidad::findOrFail($this->main_record->entidad_id);
        }else{
            $this->entidad  = Entidad::where('predeterminado',1)->first();
            $this->main_record->entidad_id = $this->entidad->id;
        }

        if($this->entidad->predeterminado && !$this->municipio_id){
            $this->municipio = Municipio::where('predeterminado',1)->first();
            $this->main_record->municipio_id = $this->municipio->id;
        }

        $this->municipios = $this->entidad->municipios()->orderby('nombre')->get();


    }
    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */

    public function store(){

        $this->reset('error_message');
        if(!$this->main_record->ine_anverso){
            $this->rules['ine_anverso'] = "required|image|max:2048";
        }else{
            $this->rules['ine_anverso'] = "nullable|image|max:2048";
        }

        if(!$this->main_record->ine_reverso){
            $this->rules['ine_reverso'] = "required|image|max:2048";
        }else{
            $this->rules['ine_reverso'] = "nullable|image|max:2048";
        }

        $this->validate();

        if($this->ine_anverso){
            if($this->imagen_anterior){
                Storage::delete($this->imagen_anterior);
            }
            $nombre_archivo = 'ine_' . str_pad($this->main_record->id, 3, '0', STR_PAD_LEFT) . '_'.$this->ine_anverso->getClientOriginalName();
            $Image = $this->ine_anverso->storeAs('public/ines',$nombre_archivo);
            $this->main_record->ine_anverso = $Image;
        }

        if($this->ine_reverso){
            if($this->imagen_anterior){
                Storage::delete($this->imagen_anterior);
            }
            $nombre_archivo = 'ine_' . str_pad($this->main_record->id, 3, '0', STR_PAD_LEFT) . '_'.$this->ine_reverso->getClientOriginalName();
            $Image = $this->ine_reverso->storeAs('public/ines',$nombre_archivo);
            $this->main_record->ine_reverso = $Image;
        }


            $this->main_record->save();
            $message = 'Datos Complementarios Actualizados';
            $this->show_alert('success',$message);
            $this->closeModal();
            $this->resetInputFields();
    }


    // Restaura campos
    public function resetInputFields(){
        $this->reset('entidad_id','municipio_id','codpos','ine_anverso','ine_reverso');
        $this->resetErrorBag();
    }


}
