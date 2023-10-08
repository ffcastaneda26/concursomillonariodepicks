<?php

namespace App\Http\Livewire;

use App\Models\Game;
use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Games extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use CrudTrait;
    use FuncionesGenerales;

    protected $listeners = ['receive_round'];

    protected $rules = [
        'main_record.round_id' => 'required|exists:rounds,id',
        'main_record.local_team_id' => 'required|exists:teams,id',
        'main_record.visit_team_id' => 'required|exists:teams,id',
        'main_record.game_day'      => 'required',
        'main_record.game_time'     => 'required',
        'main_record.local_points'  => 'nullable|numeric',
        'main_record.visit_points'  => 'nullable|numeric',
        'main_record.handicap'      => 'nullable|numeric',
    ];


    public $error_message;

    public $min_date = null;
    public $max_date = null;

    public function mount(){
        $this->update_acumulated_positions();
        $this->qualify_all_picks();

        $this->manage_title = 'Gestionar Juegos';
        $this->search_label = 'Jornada';
        $this->view_search  =  null;
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


    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */

    public function store(){
        $this->reset('error_message');
        $this->validate();

        $this->main_record->winner = null;
        if(!$this->main_record->visit_points){
            $this->main_record->visit_points = null;
        }

        if(!$this->main_record->local_points){
            $this->main_record->local_points = null;
        }

        if($this->main_record->visit_points && $this->main_record->visit_points == $this->main_record->local_points){
            $this->error_message = 'Los marcadores deben ser diferentes, no se permiten empates';
            return false;
        }

        if(empty($this->main_record->handicap)){
            $this->main_record->handicap = 0.00;
            $this->main_record->save();
        }

        // $this->main_record->winner = $this->main_record->local_points +  $this->main_record->handicap >= $this->main_record->visit_points ? 1 : 2;

        $this->main_record->winner = $this->main_record->win();
        $this->main_record->save();

        // Si se pusieron puntos se procede a calificar pronósticos
        if($this->main_record->local_points || $this->main_record->visit_points){
            $this->qualify_picks($this->main_record);                    // Califica pronósticos
            if($this->main_record->is_last_game_round()){
                $this->update_tie_breaker($this->main_record);
                $this->update_hit_last_game($this->main_record);
            }

            $this->update_total_hits( $this->selected_round);   // Actualiza tabla de aciertos por jornada (POSITIONS)
            $this->update_tie_brake($this->selected_round);     // Actualiza criterios de desempate (POSITIONS)
            $this->update_positions_by_round($this->selected_round);     // Asigna posiciones en tabla de POSITIONS
        }

        $this->show_alert('success','JUEGO ACTUALIZADO SATISFACTORIAMENTE');
        $this->receive_round( $this->main_record->round);
        $this->close_store('Juego');
    }


    // Restaura campos
    public function resetInputFields(){
        $this->main_record = new Game();
        $this->resetErrorBag();
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

    /*+----------------+
      | Recibe Jornada |
      +----------------+
    */

    public function receive_round(Round $round){
        if($round){
            $this->selected_round = $round;
            $this->round_games = $this->selected_round->games()->orderby('id')->get();
        }
    }
}
