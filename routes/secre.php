<?php

use Illuminate\Support\Facades\Route;

Route::get('/secre', function(){
    return "Hola secre";
})->name('secre.home');