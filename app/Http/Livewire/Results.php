<?php

namespace App\Http\Livewire;

use App\Models\Round;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Http\Livewire\Traits\CrudTrait;
use App\Http\Livewire\Traits\FuncionesGenerales;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Results extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    use WithFileUploads;
    use CrudTrait;
    use FuncionesGenerales;

    protected $listeners = ['receive_round'];

    public $gamesids= array();
    public $users_with_picks_round= null;

    public function mount(){
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
        return view('livewire.results.index');
    }

    /*+---------------+
      | Recibe Juegos |
      +---------------+
    */

    public function receive_round(Round $round){
        if($round){
            $this->reset('gamesids');
            $this->selected_round = $round;
            $this->gamesids[]   = $round->games()->select('id')->orderby('id')->get()->toArray();
            $this->round_games  = $round->games()->orderby('game_day')->orderby('game_time')->get();

            $this->users_with_picks_round = User::role('participante')
                                                ->select('users.*')
                                                ->Join('picks', 'picks.user_id', '=', 'users.id')
                                                ->Join('games', 'picks.game_id', '=', 'games.id')
                                                ->where('games.round_id',$round->id)
                                                ->where('users.active','1')
                                                ->groupBy('users.id')
                                                ->get();

        }
    }
}
