<?php

use App\Http\Livewire\Configurations;
use App\Http\Livewire\Games;
use App\Http\Livewire\Picks;
use App\Http\Livewire\PositionsByRound;
use App\Http\Livewire\Rounds;
use App\Http\Livewire\SelectRound;
use App\Http\Livewire\Teams;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('games',Games::class)->name('games');                                        // Juegos
    Route::get('picks',Picks::class)->name('picks');                                        // Pronósticos
    Route::get('positions-by-round',PositionsByRound::class)->name('positions-by-round');    // Pronósticos


});



Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');



Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'role:Admin'])->group(function () {
    Route::get('configurations',Configurations::class)->name('configurations');
    Route::get('teams',Teams::class)->name('teams');     // Equipos
    Route::get('rounds',Rounds::class)->name('rounds');  // Jornadas

});

Route::get('current_round',SelectRound::class);
