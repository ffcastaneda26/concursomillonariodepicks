<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\ConfigurationController;


Route::get('/',[HomeController::class,'index']);

Route::resource('configurations', ConfigurationController::class);
