<?php

namespace App\Http\Livewire;

use App\Models\Game;
use App\Models\Pick;
use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use GuzzleHttp\Psr7\Message;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Picks extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;
    use FuncionesGenerales;


    protected $rules = [
        'main_record.user_id'           => 'required|exists:users,id',
        'main_record.game_id'           => 'required|exists:games,id',
        'main_record.winner'            => 'required',
        'main_record.total_points'      => 'nullable',
        'main_record.hit'               => 'nullable',
        'main_record.visit_points'      => 'nullable',
        'main_record.local_points'      => 'nullable',
        'main_record.dif_points_winner' => 'nullable',
        'main_record.error_abs_local_visita'  => 'nullable',
        'main_record.dif_points_local'  => 'nullable',
        'main_record.dif_points_visit'  => 'nullable',
        'main_record.hit_last_game'     => 'nullable',
        'main_record.hit_local'         => 'nullable',
        'main_record.hit_visit'         => 'nullable',
        'main_record.marcador_total'       => 'nullable',
        'main_record.selected'          => 'nullable',
    ];


    protected $listeners = ['receive_round'];

    public $gamesids= array();
    public $picks = array();
    public $selected = array();

    public $message = null;
    // public $games_to_pick = array();
    public $old_picks = array();
    public $points_visit_last_game = null;
    public $points_local_last_game = null;
    public $error;
    public $allow_select = true;
    public $picks_allowed = array();
    public $picks_selected = 0;
    public $read_points_last_game = true;

    public function mount(){
        $this->read_configuration();

        $this->manage_title = 'Pronósticos';
        // $this->rounds = $this->read_rounds();
        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round =$this->current_round;


        if($this->configuration->create_mssing_picks){
            $this->create_missing_picks_to_user();
            $this->create_missing_positions_to_user();
        }

        // $this->create_positions_to_user_with_role();
        $this->receive_round($this->current_round );
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */
    public function render(){
        return view('livewire.picks.index');
    }


    /*+-----------------------------+
      | Recibe Jornada y Lee Juegos |
      +-----------------------------+
    */

    public function receive_round(Round $round){

        if($round){
            $this->selected_round = $round;
            $this->round_games = $round->games()->get();

            $i=0;
            $this->reset('selected','gamesids','picks','points_visit_last_game','points_local_last_game','error','message');

            foreach($this->round_games as $game){
                $this->gamesids[$i] = $game->id;
                $this->picks_allowed[$i] = false;
                $pick_user_record = $game->pick_user(Auth::user()->id)->first();

                if($pick_user_record){
                    $this->selected[ $game->id] = $pick_user_record->selected;
                    $this->picks[$i]=$pick_user_record->winner;
                    if($game->is_last_game_round()){
                        $this->points_visit_last_game = $pick_user_record->visit_points;
                        $this->points_local_last_game = $pick_user_record->local_points;
                    }
                    $i++;
                }
            }
        }

    }

    /**
     * Actualiza puntos del último partido
     * @param \App\Models\Game $game
     * @return void
     */
    public function update_points_last_game(Game $game){
        $this->reset('error','message');
        if($this->points_visit_last_game < 1 && $this->points_local_last_game < 1 ){
            $this->message = "Debe introducir marcador para Último Partido";
            $this->error = 'tie';
            return false;
        }

        if( strlen($this->points_visit_last_game) < 1 ){
            $this->message = "Debe Introducir Puntos Para Equipo VISITANTE del Último Partido";
            $this->error = 'visit';
            return false;
        }

        if( strlen($this->points_local_last_game) < 1 ){
            $this->message = "Debe Introducir Puntos Para Equipo LOCAL del Último Partido";
            $this->error = 'local';
            return false;
        }

        if($this->points_visit_last_game == $this->points_local_last_game){
            $this->message = "El último partido no puede ser EMPATE";
            $this->error = 'tie';
            return false;
        }
        if($this->points_visit_last_game == 1 || $this->points_local_last_game == 1){
            $this->message = "No se permite el marcador 1";
            $this->error = 'tie';
            return false;
        }
        $pick_user = $game->pick_user()->first();
        $pick_user->visit_points = $this->points_visit_last_game;
        $pick_user->local_points = $this->points_local_last_game;
        $pick_user->winner = $pick_user->local_points + $game->handicap >= $pick_user->visit_points ? 1 : 2;

        $pick_user->save();
        $pick_user->refresh();

        $this->message = "Marcador Último Partido Actualizado ";
        $this->error = "success";
    }


    /*+-----------------+
      | Guarda Registro |
      +-----------------+
    */


    public function store(){
        $this->reset('message');
        if(!$this->validate_data()) return;

        $i=0;
        foreach($this->gamesids as $game){
            $game_pick = Game::findOrFail($game);

            if($game_pick->allow_pick()){ // Se asegura que aún se pueda pronosticar
                $pick_user = $game_pick->pick_user(Auth::user()->id)->first();

                if( $pick_user){
                    $pick_user->winner = $this->picks[$i];
                    // if($game_pick->last_game_round){
                    if($game_pick->is_last_game_round()){
                        $pick_user->local_points = $this->points_local_last_game;
                        $pick_user->visit_points = $this->points_visit_last_game;
                        $pick_user->winner = $pick_user->local_points + $game_pick->handicap >= $pick_user->visit_points ? 1 : 2;
                    }
                }else{ // Cuando el juego no tiene pronóstico lo creamos
                    $pick_user = Pick::create([
                        'user_id'   => Auth::user()->id,
                        'game_id'   => $game->id,
                        'winner'    => $this->picks[$i]
                    ]);

                    // if($game->last_game_round){
                    if($game_pick->is_last_game_round()){
                        $pick_user->local_points = $this->points_local_last_game;
                        $pick_user->visit_points = $this->points_visit_last_game;
                        $pick_user->winner       = $pick_user->local_points + $game_pick->handicap >= $pick_user->visit_points ? 1 : 2;
                    }
                }

                $pick_user->selected = 0; // En caso de que antes hubiera estado seleccionado lo desmarca
                $pick_user->user_id = Auth::user()->id;
                $pick_user->save();

                // Recorre el arreglo de partidos seleccionados para marcarlos
                foreach($this->selected as $key => $value) {
                    if($pick_user->game_id == $key && $value){
                        $pick_user->selected = 1;
                        $pick_user->user_id = Auth::user()->id;
                        $pick_user->save();
                    }
                }
            }
            $i++;
        }
        $this->message = "PRONOSTICOS ACTUALIZADOS ";
        $this->error = "success";
        $this->show_alert('success','Pronósticos Guardados Satisfactoriamente');
    }

    // Validación interna
    private function validate_data(){
        $this->reset('message','error','picks_selected');

        $this->picks_selected = 0;
        foreach($this->selected as $key => $value) {
            if($value) $this->picks_selected ++;
        }

        if($this->picks_selected  != $this->configuration->picks_to_select ){
            $this->message = "Pronósticos NO ACTUALIZADOS Debe Marcar " . $this->configuration->picks_to_select . " pronósticos";
            $this->error = 'Cantidad de Pronósticos';
            return false;
        }


        if(count($this->gamesids) != count($this->picks)){
            $this->message = "Faltan pronósticos";
            $this->error = 'faltan';
        }
        if($this->points_visit_last_game < 1 && $this->points_local_last_game < 1 ){
            $this->message = "Debe introducir marcador para Último Partido";
            $this->error = 'tie';
            return false;
        }

        if( strlen($this->points_visit_last_game) < 1 ){
            $this->message = "Debe Introducir Puntos Para Equipo VISITANTE del Último Partido";
            $this->error = 'visit';
            return false;
        }

        if( strlen($this->points_local_last_game) < 1 ){
            $this->message = "Debe Introducir Puntos Para Equipo LOCAL del Último Partido";
            $this->error = 'local';
            return false;
        }

        if($this->points_visit_last_game == $this->points_local_last_game){
            $this->message = "El último partido no puede ser EMPATE";
            $this->error = 'tie';
            return false;
        }
        if($this->points_visit_last_game == 1 || $this->points_local_last_game == 1){
            $this->message = "No se permite el marcador 1";
            $this->error = 'tie';
            return false;
        }

        return true;
    }

}


