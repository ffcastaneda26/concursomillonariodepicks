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
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Picks extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;
    use FuncionesGenerales;




    protected $listeners = ['receive_round'];
    public $user_round_picks = null;

    public function mount(){
        $this->read_configuration();

        // TODO:: Revisar cuando se le debe permitir continuar

        $this->manage_title = 'Pronósticos';
        $this->rounds = $this->read_rounds();
        $round = new Round();
        $this->current_round  = $round->read_current_round();
        $this->selected_round = $this->current_round;

        // ¿Participante y no es el usuario 1?
        if(Auth::user()->hasRole('participante') && Auth::user()->id != 1){
            if($this->configuration->create_mssing_picks){
                $this->create_missing_picks_to_user($this->current_round->id);
            }
        }

        $this->receive_round($this->current_round );
    }

    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */
    public function render(){
        return view('livewire.picks.index');
    }


    /*+----------------+
      | Recibe Jornada |
      +----------------+
    */

    public function receive_round(Round $round){
        if($round){
            $this->selected_round = $round;
            $this->user_round_picks = $round->user_picks()->get();
        }
    }

    /*+---------------+
    | Guarda Registro |
    +-----------------+
    */


    public function store(){

        if(!$this->validate_data()) return;

        dd($this->selected);
        // Actualizamos los pronósticos
        $i=0;
          foreach($this->gamesids as $game){
            $game_pick = Game::findOrFail($game);


            if($game_pick->allow_pick()){
                $pick_user = $game_pick->pick_user();

                if( $pick_user){
                    $pick_user->winner = $this->picks[$i];
                    // Si es el último partido actualizamos los puntos y determinamos ganador
                    if($game_pick->is_last_game_round()){
                        $pick_user->local_points = $this->points_local_last_game;
                        $pick_user->visit_points = $this->points_visit_last_game;

                        $pick_user->winner = $pick_user->local_points + $game_pick->handicap >= $pick_user->visit_points ? 1 : 2;
                    }

                    $pick_user->save();
                }else{ // Cuando el juego no tiene pronóstico lo creamos
                    $new_pick = Pick::create([
                        'user_id'   => Auth::user()->id,
                        'game_id'   => $game->id,
                        'winner'    => $this->picks[$i]
                    ]);

                    if($game->is_last_game_round()){
                        $new_pick->local_points = $this->points_local_last_game;
                        $new_pick->visit_points = $this->points_visit_last_game;
                        $new_pick->winner       = $new_pick->local_points + $game_pick->handicap >= $new_pick->visit_points ? 1 : 2;
                    }

                    $new_pick->save();
                }
            }
            $i++;
            $this->show_alert('success','Pronósticos Guardados Satisfactoriamente');
        }


    }

    /* Crea el pronóstico */
    private function create_pick($game,$winner){
        $new_pick = Pick::create([
            'user_id'   => Auth::user()->id,
            'game_id'   => $game->id,
            'winner'    => $winner
        ]);

        if($game->is_last_game_round()){
            $new_pick->local_points = $this->points_local_last_game;
            $new_pick->visit_points = $this->points_visit_last_game;
            $new_pick->winner       = $new_pick->local_points > $new_pick->visit_points ? 1 : 2;
        }

        $new_pick->save();

    }

    // Validación interna
    private function validate_data(){
        $this->reset('message','error');
        // TODO: Validar que los partidos seleccionados sean los pronosticados

        dd(count($this->selected));
        if(count($this->selected) != $this->configuration->picks_to_select ){
            $this->message = "Debe Marcar " . $this->configuration->picks_to_select . " pronósticos";
            $this->error = 'Cantidad de Pronósticos';
            return false;
        }


        if(count($this->gamesids) != count($this->picks)){
            $this->message = "Faltan pronósticos";
            $this->error = 'faltan';
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
            $this->message = "El últimoo partido no puede ser EMPATE";
            $this->error = 'tie';
            return false;
        }
        return true;
    }


    /** Solo para revisar si es necesario */
    public function revisar(){
        $this->reset('picks');
        $i=0;
        foreach($this->gamesids as $game){
            $game_pick = Game::findOrFail($game);
            $pick_user = $game_pick->pick_user();
            $this->picks[$i]=$pick_user->winner;
            $i++;
        }

        $revisar = array();
        $i=0;
        foreach($this->gamesids as $game){
            $revisar[$i][0] = $this->picks[$i];
            $revisar[$i][1] = $this->old_picks[$i];
            $i++;
        }

    }

}


