<?php

namespace App\Http\Livewire;

use App\Models\Pick;
use App\Models\User;
use App\Models\Round;
use Livewire\Component;

class PicksRoundUser extends Component
{
    public $user;
    public $round;
    public $cols_show= [];

    public function mount(User $user,Round $round){
        $this->reset('cols_show');
            $games = $round->games()->select('id as game_id')->orderby('id')->get();
            $picks = $round->picks_user($user->id)->select('game_id')->get();
            $i=0;
            foreach($games as $game){
                $this->cols_show[$i] = false;
                foreach($picks as $pick){
                    if ($game->game_id == $pick->game_id){
                        $this->cols_show[$i] = $pick->game_id;
                        break;
                    }
                }
                $i++;
            }
    }

    public function render()
    {
        return view('livewire.results.picks-round-user');
    }
}
