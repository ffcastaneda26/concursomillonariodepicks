<?php

use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/',function(){
    $games = game::whereDoesntHave('picks', function (Builder $query) {
        $query->where('user_id',Auth::user()->id);
    })->get();
    dd($games);
});




