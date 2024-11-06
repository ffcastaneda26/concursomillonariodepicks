<?php

use App\Http\Livewire\AdminPicks;
use App\Http\Livewire\Bets;
use App\Http\Livewire\Games;
use App\Http\Livewire\Teams;
use App\Http\Livewire\Rounds;
use App\Http\Livewire\Results;
use App\Http\Livewire\SelectRound;
use App\Http\Livewire\Configurations;
use App\Http\Livewire\Picks;

use App\Http\Livewire\PicksRoundUser;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Positions\ByRound;
use App\Http\Livewire\Positions\General;
use App\Http\Livewire\Positions\GeneralPositions;
use App\Http\Livewire\Positions\GeneralPositionsExtra;
use App\Http\Livewire\QualifyGames;
use App\Http\Livewire\Users;
use App\Models\Configuration;
use App\Models\GeneralPosition;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session')])->group(function () {

    Route::get('/dashboard', function () {
        // $configuration_record = Configuration::first();
        return view('dashboard');
    })->name('dashboard');

    Route::get('games',Games::class)->name('games');                                // Juegos
    Route::get('picks',Picks::class)->name('picks');                                // Pronósticos
    Route::get('positions-by-round',ByRound::class)->name('positions-by-round');    // Posiciones x Jornada
    Route::get('positions-general',General::class)->name('positions-general');      // Posiciones General
    Route::get('general-positions',GeneralPositions::class)->name('general-positions'); // Posiciones General
    Route::get('results-by-round',Results::class)->name('results-by-round');        // Resultados x Jornada
    // Route::get('concurso-consola',GeneralPositionsExtra::class)->name('concurso-consola'); // Concurso consola
});



Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'role:Admin'])->group(function () {
    Route::get('configurations',Configurations::class)->name('configurations'); // Configuración General
    Route::get('teams',Teams::class)->name('teams');                    // Equipos
    Route::get('rounds',Rounds::class)->name('rounds');                 // Jornadas
    Route::get('users',Users::class)->name('users');                    // Usuarios
    Route::get('picks-admin',AdminPicks::class)->name('admin-picks');   // Pronósticos x Administrador
    Route::get('qualify-picks',QualifyGames::class)->name('qualify-picks'); // Califica pronósticos
    Route::get('bets',Bets::class)->name('bets');
});

Route::get('current_round',SelectRound::class);



