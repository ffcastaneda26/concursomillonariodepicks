<?php

namespace App\Http\Livewire;

use App\Models\Entidad;
use Livewire\Component;
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

    protected $listeners = ['store_data'];


    protected $rules = [
        'entidad_id'    => 'required|exists:entidades,id',
        'municipio_id'  => 'required|exists:municipios,id',
        'codpos'        => 'required|numeric',
        'ine_anverso'   => 'required|image|max:2048|mimes:jpg,jpeg,png',
        'ine_reverso'   => 'required|image|max:2048|mimes:jpg,jpeg,png',
        'confirmar'     => 'accepted',
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
    public $extensions_file = ['jpg','jpeg','png'];
    public $confirmar   = null;

    public function mount(){
        $this->manage_title = 'Datos Complementarios';
        $this->search_label = null;
        $this->view_search  = null;
        $this->view_form    = 'livewire.games.form';
        $this->view_table   = 'livewire.games.table';
        $this->view_list    = 'livewire.games.list';
        $this->allow_create = true;
        $this->lee_entidades();
        if(Auth::user()->entidad_id){
            $this->entidad_id = Auth::user()->entidad_id;
        }

        if(Auth::user()->municipio_id){
            $this->municipio_id = Auth::user()->municipio_id;
        }

        if(Auth::user()->codpos){
            $this->codpos = Auth::user()->codpos;
        }
        $this->lee_entidad();
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){
        if(Auth::user()->entidad_id){
            $this->entidad_id = Auth::user()->entidad_id;
        }

        if(Auth::user()->municipio_id){
            $this->municipio_id = Auth::user()->municipio_id;
        }

        if(Auth::user()->codpos){
            $this->codpos = Auth::user()->codpos;
        }

        return view('livewire.datausers.index');
    }


    public function store_data(){
        dd('Llegaste a la tierra prometida');
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
        if($this->entidad_id){
            $this->entidad = Entidad::findOrFail($this->entidad_id);
            $this->municipios = $this->entidad->municipios()->orderby('nombre')->get();
        }

        // else{
        //     $this->entidad  = Entidad::where('predeterminado',1)->first();
        //     $this->entidad_id = $this->entidad->id;
        // }

        // if(!$this->entidad->predeterminado && !$this->municipio_id){
        //     $this->municipio = Municipio::where('predeterminado',1)->first();
        //     $this->municipio_id = $this->municipio->id;
        // }

    }
    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */

    public function store(){

        $this->reset('error_message');

        $this->validate();

        if($this->ine_anverso){
            if($this->imagen_anterior){
                Storage::delete($this->imagen_anterior);
            }
            $nombre_archivo = 'ine_' . str_pad(Auth::user()->id, 3, '0', STR_PAD_LEFT) . '_'.$this->ine_anverso->getClientOriginalName();
            $Image = $this->ine_anverso->storeAs('public/ines',$nombre_archivo);
            Auth::user()->ine_anverso = $Image;
        }

        if($this->ine_reverso){
            if($this->imagen_anterior){
                Storage::delete($this->imagen_anterior);
            }
            $nombre_archivo = 'ine_' . str_pad(Auth::user()->id, 3, '0', STR_PAD_LEFT) . '_'.$this->ine_reverso->getClientOriginalName();
            $Image = $this->ine_reverso->storeAs('public/ines',$nombre_archivo);
            Auth::user()->ine_reverso = $Image;
        }

            Auth::user()->entidad_id = $this->entidad_id;
            Auth::user()->municipio_id = $this->municipio_id;
            Auth::user()->codpos = $this->codpos;
            Auth::user()->save();
            Auth::user()->refresh();
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
