<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return "Hola eco";
})->name('eco.home');