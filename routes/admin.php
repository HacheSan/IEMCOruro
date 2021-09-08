<?php

use App\Http\Controllers\Admin\Activity;
use App\Http\Controllers\Admin\Economy;
use App\Http\Controllers\Admin\Inventory;
use App\Http\Controllers\Admin\Member;
use App\Http\Controllers\Admin\User;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function(){
    return "Hola admin";
})->name('admin.home'); */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
Route::resource('/usuarios', User::class)->names('admin.usuarios');
Route::resource('/miembros', Member::class)->names('admin.miembros');
Route::resource('/actividades', Activity::class)->names('admin.actividades');
Route::resource('/inventarios', Inventory::class)->names('admin.inventarios');
Route::resource('/economia', Economy::class)->names('admin.economia');