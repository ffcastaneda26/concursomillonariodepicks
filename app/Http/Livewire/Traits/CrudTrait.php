<?php

namespace App\Http\Livewire\Traits;

use App\Models\Round;
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
    public $show_back = false;

    public $message;
    private $pagination = 8; //paginación de tabla
    public $per_page = 8;

    public $confirm_delete =false;
    public $action_form;

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
    public $rounds          = null;
    public $teams           = null;
    public $logotipo        = null;
    public $imagen_anterior = null;

    // Registros
    public $round   = null;
    public $team    = null;

    // Id de registros
    public $round_id    = null;
    public $msg_error = null;

    // Ordenar consultas
    public $sort = 'id';
    public $direction ='asc';

   	//permite la búsqueda cuando se navega entre el paginado

    public function updatingSearch()
    {
        $this->resetPage();
    }


    /** Lee Entidades Federativas */
    public function lee_jornadas(){
        $this->entidades    = Round::orderby('id')->get();
    }

    /** Entidades para el domicilio */
    public function lee_jornada(){
        if($this->round_id){
            $this->round = Round::findOrFail($this->round_id);
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
            }else{
            }
        }

        if($action == 'delete'){
            $this->confirm_delete = true;
            $this->isOpen = false;
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
        $this->reset('search');
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



}
