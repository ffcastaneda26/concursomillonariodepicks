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
use App\Models\Bet;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPicks extends Component
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
    public $bets_selected = array();
    public $count_bets;
    public $message = null;
    // public $games_to_pick = array();
    public $old_picks = array();

    public $points_visit_last_game;
    public $points_local_last_game;
    public $error;
    public $allow_select = true;
    public $picks_allowed = array();
    public $picks_selected = 0;

    public $bets;
    public $bet_id;

    public function mount(){

        $this->read_configuration();
        $this->manage_title = 'Pronósticos';
        $this->rounds = $this->read_rounds();

        $round = new Round();
        $this->current_round = $round->read_current_round();
        $this->selected_round =$this->current_round;
        $this->users= $this->read_users_role('participante');

        $this->create_positions_to_user_with_role();
        $this->receive_round($this->current_round );
        $this->update_false_winner();
    }
    private function update_false_winner(){
        $sql="SELECT COUNT(*) ";
        $sql.="FROM  games ga, picks pic ";
        $sql.="WHERE ga.id = pic.game_id";
        $sql.="  AND if(pic.local_points + ga.handicap > pic.visit_points,1,2) <> pic.winner";
        $sql.="  AND (pic.local_points IS NOT NULL OR pic.visit_points IS NOT NULL) ";

        $false_winner_exist = DB::update($sql);
        if($false_winner_exist){
            $sql= "UPDATE  users us,games ga,picks pic set pic.winner = if(pic.local_points + ga.handicap > pic.visit_points,1,2) ";
            $sql.= "WHERE us.id = pic.user_id ";
            $sql.= "  AND ga.id = pic.game_id";
            $sql.= "  AND pic.local_points IS NOT NULL";
            $sql.= "  AND pic.visit_points IS NOT NULL";
            $sql.="   AND if(pic.local_points + ga.handicap >= pic.visit_points,1,2) <> pic.winner";
            DB::update($sql);
        }
    }
    /*+---------------------------------+
      | Regresa Vista con Resultados    |
      +---------------------------------+
    */
    public function render(){

        return view('livewire.admin_picks.index');
    }


    /*+---------------+
      | Recibe Jornada |
      +---------------+
    */

    public function receive_round(Round $round){
        if($round){

            $this->selected_round = $round;
            $this->reset('round_games','selected','gamesids','picks','points_visit_last_game','points_local_last_game','error','message');

            if(!$this->user){
                $this->message = 'Seleccione Usuario';
                return;
            }

            $i=0;
            $this->round_games = $round->games()->get();
            $this->bets_selected = [];
            foreach($this->round_games as $game){
                $this->gamesids[$i]     = $game->id;
                $this->picks_allowed[$i]= false;
                $pick_user              = $game->pick_user($this->user->id)->first();

                if( $pick_user){
                    $this->selected[ $game->id] =  $pick_user->selected;
                    if($pick_user->selected){
                        $this->bets_selected[$game->id] = $pick_user->bet_id;
                    }
                    $this->picks[$i]= $pick_user->winner;
                    if($game->is_last_game_round()){
                        $this->points_visit_last_game =  $pick_user->visit_points;
                        $this->points_local_last_game =  $pick_user->local_points;
                    }
                    $i++;
                }
            }
        }

    }

    /*+---------------------------------------------+
      |                 Lee Usuario                 |
      +---------------------------------------------+
      | Si no tiene pronósticos los crea            |
      | Si no tiene registro en posiciones lo crea  |
      +---------------------------------------------+
    */
    public function read_user(){
        if($this->user_id){
            $this->user = User::findOrFail($this->user_id);
            if($this->configuration->create_mssing_picks){
                $this->create_missing_picks_user($this->user);
                $this->create_missing_positions_to_user();
            }
            if($this->user->require_bet){
                $this->bets = Bet::orderBy('name')->get();
            }else{
                $this->bets = null;
            }
            $this->receive_round($this->current_round );
        }
    }

    /*+---------------------+
      | Guarda Pronósticos  |
      +---------------------+
    */

    public function store(){
        $this->reset('message');
        if(!$this->validate_data()) return;


        $i=0;
        foreach($this->gamesids as $game){
            $game_pick = Game::findOrFail($game);

            if($game_pick->allow_pick() || Auth::user()->hasRole('Admin')){ // Se asegura que aún se pueda pronosticar

                $pick_user = $game_pick->pick_user($this->user->id)->first();

                if( $pick_user){
                    $pick_user->winner = $this->picks[$i];
                    if($game_pick->last_game_round){
                        $pick_user->local_points = $this->points_local_last_game;
                        $pick_user->visit_points = $this->points_visit_last_game;
                        $pick_user->winner = $pick_user->local_points + $game_pick->handicap >= $pick_user->visit_points ? 1 : 2;
                    }
                }else{ // Cuando el juego no tiene pronóstico lo creamos
                        $pick_user = Pick::create([
                            'user_id'   => $this->user->id,
                            'game_id'   => $game->id,
                            'winner'    => $this->picks[$i]
                        ]);

                        if($game->last_game_round){
                            $pick_user->local_points = $this->points_local_last_game;
                            $pick_user->visit_points = $this->points_visit_last_game;
                            $pick_user->winner       = $pick_user->local_points + $game_pick->handicap >= $pick_user->visit_points ? 1 : 2;
                        }
                }


                $pick_user->selected = 0; // En caso de que antes hubiera estado seleccionado lo desmarca
                $pick_user->save();

                foreach($this->selected as $key => $value) {
                    if($pick_user->game_id == $key && $value){
                        $pick_user->selected = 1;
                        $pick_user->updated_user_id = Auth::user()->id;
                        if($pick_user->user->require_bet){
                            foreach($this->bets_selected as $key => $bet){
                                if($pick_user->game_id == $key && $bet){
                                    $pick_user->bet_id = $bet;
                                }
                            }
                        }

                        $pick_user->save();
                    }
                }
            }
            $i++;

        }
        $this->message = "PRONOSTICOS ACTUALIZADOS ";
        $this->error = "success";
        $this->show_alert('success','Pronósticos Guardados Satisfactoriamente');
        $this->receive_round($this->current_round);
    }

    // Validación interna
    private function validate_data(){
        $this->reset('message','error','picks_selected','count_bets');

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

        // Valida las apuestas
        if($this->user->require_bet){

            foreach($this->bets_selected as $key => $value){
                if($value) $this->count_bets++;
            }


            if($this->count_bets  != $this->configuration->picks_to_select ){
                $this->message = "Pronósticos NO ACTUALIZADOS Debe Seleccionar " . $this->configuration->picks_to_select . " apuestas";
                $this->error = 'Cantidad de Apuestas';
                return false;
            }

            $games_selected = array_keys($this->selected, 1, true);
            $all_games_selected_has_bet = array_diff($games_selected, array_keys( $this->bets_selected)) === [];
            if(!$all_games_selected_has_bet){
                $this->message = "Partidos Seleccionados sin Apuesta";
                $this->error = 'Partidos sin Apuesta';
                return false;
            }

            // Revisar que se hayan seleccionado apuestas diferentes en todos los partidos
            $filteredArray = array_filter($this->bets_selected);
            $invertedArray = array_flip($filteredArray);
            $uniqueInvertedArray = array_unique($invertedArray);
            $belts_selected_unique = array_flip($uniqueInvertedArray);
            $bets_ok = count($filteredArray) == count($belts_selected_unique);

            if(!$bets_ok){
                $this->message = "Revise las apuestas hay duplicadas";
                $this->error = 'Partidos sin Apuesta';
                return false;
            }
        }
        return true;
    }

        /**
     * Actualiza puntos del último partido
     * @param \App\Models\Game $game
     * @return bool
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
        $pick_user = $game->pick_user($this->user->id)->first();
        $pick_user->local_points = $this->points_local_last_game;
        $pick_user->visit_points = $this->points_visit_last_game;

        $pick_user->winner = $this->points_local_last_game + $game->handicap >= $this->points_visit_last_game ? 1 : 2;
        $pick_user->save();
        $pick_user->refresh();
        // dd('Locales =' .$pick_user->local_points . ' Visita=' . $pick_user->visit_points . ' Línea= ' .  $game->handicap . ' Winner=' . $pick_user->winner );

        $this->message = "Marcador Último Partido Actualizado ";
        $this->error = "success";
    }

}



