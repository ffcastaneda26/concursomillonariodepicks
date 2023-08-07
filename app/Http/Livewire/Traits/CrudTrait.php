<?php

namespace App\Http\Livewire\Traits;

use App\Models\Logia;
use App\Models\Mason;
use App\Models\Status;
use App\Models\Entidad;
use App\Models\Municipio;
use App\Models\Profano;
use App\Models\TipoEstado;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

trait CrudTrait {


    protected $paginationTheme = 'bootstrap';
    public $image_path;
    public $updating_record = false;
    public $main_record;
    public $manage_title,$create_button_label,$search_label;
    public $record_id,$record;
	public $search,$searchTerm;
    public $isOpen = false;
    public $allow_create=true;
    public $allow_edit=true;
    public $allow_=true;

    public $back_route = null;
    public $predeterminado = false;
    public $activa = true;
    public $mostrar_logias = true;
    public $show_back = false;

    public $message;
    private $pagination = 10; //paginación de tabla
    public $per_page = 10;

    public $member_auth_user;
    public $confirm_delete =false;
    public $action_form;
    public $show_delete_detail = false;
    public $only_linked = false;
    public $show_only_linked = true;

    // Permisos
    public $permission_create;
    public $permission_edit;
    public $permission_delete;
    public $permission_view;


    // Vistas
    public $view_search = 'common.crud_search';
    public $view_modal = 'common.crud_modal_form';
    public $view_form;
    public $view_table;
    public $view_list;
    public $view_index;
    public $modal_size = null;
    public $modal_width = null;



    // Encabezado de lista de registros
    public $show_header_card = false;
    public $header_card;

    // Listas desplegables
    public $logias          = null;
    public $distritos       = null;
    public $entidades       = null;
    Public $municipios      = null;
    public $statuses        = null;
    public $grados          = null;
    Public $dias_trabajos   = null;
    public $logotipo        = null;
    public $imagen_anterior = null;
    public $puestos         = null;
    public $reconocimientos = null;
    public $aficiones       = null;
    public $escolaridades   = null;
    public $masones         = null;
    public $mason           = null;
    public $estados_civiles = null;
    public $estados         = null;
    public $organismos      = null;
    public $sectores        = null;
    public $areas           = null;
    public $profanos        = null;
    public $formas_de_ingreso = null;
    public $tipos_estado = null;
    public $estados_siguientes = null;
    public $tipos_documento = null;


    // Registros
    public $rol_usuario = null;
    public $logia_usuario = null;
    public $registro_tipo_estado = null;
    public $logia       = null;
    public $sector      = null;
    public $area        = null;
    public $profano     = null;
    public $entidad     = null;
    public $forma_ingreso=null;
    public $tipo_estado = null;
    public $tipo_documento = null;
    public $radio       = null;

    // Id de registros
    public $logia_id    = null;
    public $sector_id   = null;
    public $area_id     = null;
    public $profano_id  = null;
    public $forma_ingreso_id = null;
    public $tipo_estado_id  = null;
    public $tipo_documento_id = null;


    public $msg_error = null;
    public $default_status = null;


    // Variables para el domicilio
    public $entidad_id  = 6;
    public $municipio_id= null;
    public $municipio   = null;
    public $localidad   = null;
    public $direccion   = null;
    public $colonia     = null;
    public $codpos      = null;




    // Ordenar consultas
    public $sort = 'id';
    public $direction ='asc';

   	//permite la búsqueda cuando se navega entre el paginado

    public function updatingSearch()
    {
        $this->resetPage();
    }


    /** Lee Entidades Federativas */
    public function lee_entidades(){
        $this->entidades    = Entidad::orderby('id')->get();
    }

    /** Entidades para el domicilio */
    public function lee_entidad(){
        $this->reset('entidad','municipio_id','municipios','municipio');

        if($this->entidad_id){
            $this->entidad = Entidad::findOrFail($this->entidad_id);
            $this->municipios = $this->entidad->municipios()->orderby('id')->get();
        }
    }

    /** Lee municipios de una entidad */
    public function lee_municipios(Entidad $entidad){

        $this->entidad = $entidad;
        $this->municipios = $this->entidad->municipios()->orderby('nombre')->get();

    }

    /** Lee el municipio */
    public function lee_municipio(){
        $this->reset('municipio');
        if($this->municipio_id){
            $this->municipio = Municipio::findOrFail($this->municipio_id);
        }
    }


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	public function create() {
		$this->resetInputFields();
        $this->resetErrorBag();
		$this->openModal();
	}


	/*+---------------------------------------------+
	  | Habilita variable para presentar Modal      |
      +---------------------------------------------+
	 */
	public function openModal($action='edit',$modal = 1) {
        $this->resetErrorBag();

        if($action == 'edit'){
            $this->confirm_delete = false;
            if($modal == 1){
                $this->isOpen = true;
                $this->open2 = false;
            }else{
                $this->isOpen = false;
            }
        }

        if($action == 'delete'){
            $this->confirm_delete = true;
            $this->isOpen = false;
            $this->open2 = false;
        }

	}

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	public function closeModal() {
        $this->isOpen = false;
        $this->confirm_delete = false;
        $this->reset('search','logotipo');

        $this->resetInputFields();
    }



    private function delete_record($record,$message){
        $record->delete();
        $this->show_alert('success',$message);
        $this->closeModal();
    }

    private function store_message($message){

        $action_message = $this->record_id ? __('Updated')  : __('Created');
        $action_message .= ' ' . __('Successfully!!');
        $message.= ' ' . $action_message;
        $this->show_alert('success',$message);
        $this->closeModal();
        $this->resetInputFields();
        $this->open = true;

    }

    // Alerta
    private function show_alert($type,$message){
        $this->dispatchBrowserEvent('alert',[
            'type'=>$type,
            'message'=> $message
        ]);
    }

    // Cierra luego de hacer el store
    public function close_store($entity='Record'){
        $this->main_record->save();
        $this->resetInputFields();
        $this->closeModal();
        $this->create_button_label = __('Create') . ' ' . __($entity);
        $this->store_message(__($entity));
        $this->resetErrorBag();
    }



    public function delete_image($record,$directory_file)
    {
        $tmpImg = $record->image_path;
        if($tmpImg !=null && file_exists('storage/'.$directory_file.'/' .$tmpImg)){
            unlink('storage/'.$directory_file.'/' .$tmpImg);
        }
    }

    // Ordernar por algun campo
    public function order($orderby){
        if($this->sort == $orderby){
            if($this->direction == 'asc'){
                $this->direction = 'desc';
            }else{
                $this->direction = 'asc';
            }
        }else{
            $this->sort = $orderby;
            $this->direction = 'asc';
        }
    }

    /** Valida de forma general la CURP */
    public function validaCURP($curp){
        $regex ="/^[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{2}";
        $regex.="(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])";
        $regex.="[HM]{1}";
        $regex.="(AS|BC|BS|CC|CS|CH|CL|CM|DF|DG|GT|GR|HG|JC|MC|MN|MS|NT|NL|OC|PL|QT|QR|SP|SL|SR|TC|TS|TL|VZ|YN|ZS|NE)";
        $regex.= "[B-DF-HJ-NP-TV-Z]{3}";
        $regex.= "[0-9A-Z]{1}[0-9]{1}$";
        $regex.= "/";
        return preg_match($regex, $curp);
    }

    /** Validar de forma general el RFC */
    public function validaRFC($rfc){
        $regex = "/^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])([A-Z]|[0-9]){2}([A]|[0-9]){1})?$/";
        return preg_match($regex, $rfc);
    }

    /** Si rol requiere logia la deja seleccionada si no pone todas */

    public function rol_requiere_logia(){
        $this->rol_usuario = Auth::user()->roles->first();

        if($this->rol_usuario->require_lodge){
            $this->logia_usuario    = Auth::user()->logias->first();
            $this->logia            = $this->logia_usuario;
            $this->logia_id         = $this->logia_usuario->id;
            $this->mostrar_logias   = false;
        }else{
            $this->logias = Logia::orderby('logia')->where('activa',1)->get();
            $this->mostrar_logias   = true;

        }
    }


    /** Lee Logia */
    public function lee_logia(Logia $logia){
        $this->masones = null;
        if($this->logia_id){
            $this->logia = Logia::findOrFail($this->logia_id);
        }

    }

    /** Lee Tipo de Estado */
    public function lee_tipo_estado(){
        $this->tipo_estado = null;
        if($this->tipo_estado_id){
            $this->tipo_estado = TipoEstado::findOrFail($this->tipo_estado_id);
        }
    }

    /** Hermano  para asignar familiares */
    public function lee_mason(Mason $mason){
        $this->mason = $mason;
    }

    /** Profano  para asignar Algo */
    public function lee_profano(Profano $profano){
        $this->profano = $profano;
    }

    /** Lee registro de estado activo */
    public function lee_registro_tipo_estado($tipo = 'Logias'){
        return TipoEstado::Where('nombre',$tipo)->first();
    }

}
