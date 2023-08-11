<?php

namespace App\Http\Livewire;

use App\Models\Game;
use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Games extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;
    use FuncionesGenerales;

    protected $listeners = ['receive_round'];

    // protected $rules = [
    //     'main_record.round_id'      => 'required|exists:rounds,id',
    //     'main_record.local_team_id' => 'required|exists:teams,id',
    //     'main_record.visit_team_id' => 'required|exists:teams,id',
    //     'main_record.local_points'  => 'required|numeric',
    //     'main_record.visit_points'  => 'required|numeric',
    //     'main_record.game_day'      => 'required',
    //     'main_record.game_time'     => 'required',
    //     'main_record.game_date'     => 'required',
    //     'main_record.winner'        => 'nullable',
    // ];

    protected $rules = [
        'main_record.local_points' => 'required|numeric',
        'main_record.visit_points' => 'required|numeric',

    ];
    public $error_message;

    public function mount(){
        $this->manage_title = 'Gestionar Juegos';
        $this->search_label = 'Jornada';
        $this->view_search  =null;
        $this->view_form    = 'livewire.games.form';
        $this->view_table   = 'livewire.games.table';
        $this->view_list    = 'livewire.games.list';
        $this->rounds       = $this->read_rounds();
        $this->teams        = $this->read_teams();
        $this->allow_create = false;
        $this->main_record  = new Game();
        $this->sort         = 'round_id';
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round =$this->current_round;
        $this->receive_round($this->current_round );
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */

    public function render(){

        $this->create_button_label = $this->main_record->id ?  'Actualizar Juego' :  ' Crear Juego';

        return view('livewire.games.index');
    }


    public function resetInputFields(){
        $this->main_record = new Game();

        $this->resetErrorBag();
    }

    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */

    public function store(){

        $this->reset('error_message');
        $this->validate();

        if($this->main_record->visit_points == $this->main_record->local_points){
            $this->error_message = 'Los marcadores deben ser diferentes, no se permiten empates';
            return false;
        }
        $this->main_record->save();
        $this->main_record->winner = $this->main_record->local_points > $this->main_record->visit_points ? 1 : 2;
        $this->receive_round( $this->main_record->round);
        $this->close_store('Juego');

    }

    /*+------------------------------+
    | Lee Registro Editar o Borar  |
    +------------------------------+
    */

    public function edit(Game $record){

        $this->main_record  = $record;
        $this->record_id    = $record->id;
        $this->openModal();

    }

    /*+---------------+
      | Recibe Juegos |
      +---------------+
    */

    public function receive_round(Round $round){

        if($round){
            $this->selected_round = $round;
            $this->round_games = $round->games()->orderby('id')->get();
        }

    }

}
