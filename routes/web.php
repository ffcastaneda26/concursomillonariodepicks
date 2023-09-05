<?php

use App\Http\Livewire\Games;
use App\Http\Livewire\Picks;
use App\Http\Livewire\Teams;
use App\Http\Livewire\Rounds;
use App\Http\Livewire\Results;
use App\Http\Livewire\SelectRound;
use App\Http\Livewire\Configurations;
use App\Http\Livewire\PicksRoundUser;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Positions\ByRound;
use App\Http\Livewire\Positions\General;
use App\Models\Configuration;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session')])->group(function () {

    Route::get('/dashboard', function () {
        $configuration_record = Configuration::first();
        return view('dashboard',compact('configuration_record'));
    })->name('dashboard');

    Route::get('games',Games::class)->name('games');                                // Juegos
    Route::get('picks',Picks::class)->name('picks');                                // Pronósticos
    Route::get('positions-by-round',ByRound::class)->name('positions-by-round');    // Posiciones x Jornada
    Route::get('positions-general',General::class)->name('positions-general');      // Posiciones General
    Route::get('results-by-round',Results::class)->name('results-by-round');        // Resultados x Jornada
    Route::get('picks-round-user/{user}/{round}',PicksRoundUser::class)->name('picks-round-user'); // Pronósticos del usuario en una jornada


});



Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'role:Admin'])->group(function () {
    Route::get('configurations',Configurations::class)->name('configurations'); // Configuración General
    Route::get('teams',Teams::class)->name('teams');                    // Equipos
    Route::get('rounds',Rounds::class)->name('rounds');                 // Jornadas
});

Route::get('current_round',SelectRound::class);




