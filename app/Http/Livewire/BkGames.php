<?php

namespace App\Http\Livewire;

use App\Models\Team;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use App\Models\Game;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BkGames extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;
    use FuncionesGenerales;

    protected $listeners = ['destroy'];
    protected $rules = [
        'main_record.round_id'      => 'required|exists:rounds,id',
        'main_record.local_team_id' => 'required|exists:teams,id',
        'main_record.visit_team_id' => 'required|exists:teams,id',
        'main_record.local_points'  => 'nullable',
        'main_record.game_day'      => 'required',
        'main_record.game_time'     => 'required',
        'main_record.game_date'     => 'required',
        'main_record.winner'        => 'nullable',
    ];


    public function mount(){
        $this->manage_title = 'Gestionar Juegos';
        $this->search_label = 'Equipo';
        $this->view_form    = 'livewire.ames.form';
        $this->view_table   = 'livewire.ames.table';
        $this->view_list    = 'livewire.ames.list';
        $this->rounds       = $this->read_rounds();
        $this->teams       = $this->read_teams();
        $this->main_record  = new Game();
        $this->sort         = 'round_id';
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){
        $this->create_button_label = $this->main_record->id ?  'Actualizar Juego' :  ' Crear Juego';


        return view('livewire.games.index');

    }

    public function resetInputFields()
    {
        $this->main_record = new Team();
        $this->resetErrorBag();
    }

    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */

    public function store(){
        $this->rules['main_record.name'] = $this->main_record->id ? "required|min:3|max:50|unique:ames,name,{$this->main_record->id}"
                                                                  : 'required|min:3|max:50|unique:ames,name';
        $this->rules['main_record.alias'] = $this->main_record->id ? "required|min:3|max:20|unique:ames,alias,{$this->main_record->id}"
                                                                  : 'required|min:3|max:20|unique:ames,alias';
        $this->rules['main_record.short'] = $this->main_record->id ? "required|min:3|max:3|unique:ames,short,{$this->main_record->id}"
                                                                  : 'required|min:3|max:3|unique:ames,short';
        $this->validate();


        if($this->logotipo){
            if($this->imagen_anterior){
                Storage::delete($this->imagen_anterior);
            }
            $nombre_archivo = 'logo_' . str_pad($this->main_record->id, 3, '0', STR_PAD_LEFT) . '_'.$this->logotipo->getClientOriginalName();
            $Image = $this->logotipo->storeAs('public/ames',$nombre_archivo);
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
        $this->openModal();
    }

    /*+------------------------------+
      | Elimina Registro             |
      +------------------------------+
    */
    public function destroy(Team $record)
    {

        // if($record->local_games()->count()) $record->local_games()->delete();
        // if($record->visit_games()->count()) $record->visit_games()->delete();

        $this->delete_record($record, __('Equipo Eliminado Satisfactoriamente!!'));
    }
}

