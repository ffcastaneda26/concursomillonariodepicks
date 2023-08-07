<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RoundController;
use App\Http\Controllers\TeamController;

Route::get('/',[HomeController::class,'index']);

Route::resource('configurations', ConfigurationController::class);
Route::resource('teams', TeamController::class);
Route::resource('rounds', RoundController::class);
Route::resource('games', GameController::class);



