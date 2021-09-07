<?php

use App\Http\Controllers\Admin\User;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function(){
    return "Hola admin";
})->name('admin.home'); */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
Route::resource('/usuarios', User::class)->names('admin.usuarios');