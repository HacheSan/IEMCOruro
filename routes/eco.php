<?php

use Illuminate\Support\Facades\Route;

Route::get('/eco', function(){
    return "Hola eco";
})->name('eco.home');