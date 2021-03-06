<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AssistanceController;
use App\Http\Controllers\Admin\BoxTypeController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\EconomyController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Member;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

/* Route::get('/', function(){
    return "Hola admin";
})->name('admin.home'); */
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('admin.home');
Route::resource('/usuarios', UserController::class)->names('admin.usuarios');
Route::resource('/miembros', MemberController::class)->names('admin.miembros');
Route::resource('/actividades', ActivityController::class)->names('admin.actividades');
Route::resource('/inventarios', InventoryController::class)->names('admin.inventarios');
Route::resource('/economia', EconomyController::class)->names('admin.economia');
Route::resource('/asistencias', AssistanceController::class)->names('admin.asistencias');
Route::resource('/certificados', CertificateController::class)->names('admin.certificados');
Route::resource('/cajas', BoxTypeController::class)->names('admin.cajas');

Route::post('actividadimagen', [ActivityController::class, 'actividadimagen']);

Route::get('search', [UserController::class, 'search'])->name('admin.search');
Route::post('buscarmiembro', [App\Http\Controllers\Admin\UserController::class, 'buscarmiembro'])->name('admin.buscarmiembro');
Route::post('searchmember', [MemberController::class, 'searchMember'])->name('admin.searchmember');

Route::post('tblassistance', [AssistanceController::class, 'tblAssistance'])->name('admin.tblassistance');
Route::post('destroyassistance', [AssistanceController::class, 'destroyAssistance'])->name('admin.destroyassistance');

Route::post('reportassistance', [AssistanceController::class, 'reportAssistance'])->name('admin.reportassistance');

Route::post('updatecertificate', [CertificateController::class, 'update'])->name('admin.certificados.updatecertificate');

Route::get('/admin/certificados/{id}/confirm', [CertificateController::class, 'destroyCertificate'])->name('admin.deletecertconfirm');
//table economy
Route::post('/admin/economia', [EconomyController::class, 'tblEconomy'])->name('admin.tbleconomy');
