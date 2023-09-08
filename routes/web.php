<?php

use App\Http\Controllers\AutenticadoController;
use App\Http\Controllers\AutenticarController;
use App\Http\Controllers\EscritorioController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\FamiliaMiembroController;
use App\Http\Controllers\MiembroAjaxController;
use App\Http\Controllers\MiembroController;
use App\Http\Controllers\MiembroExportController;
use App\Http\Controllers\MiembroMinisterioController;
use App\Http\Controllers\MinisterioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VisitaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Autenticado

Route::middleware(['web', 'auth'])->group(function () {
    // Miembros
    Route::delete('miembros/{miembro}/familia', [FamiliaMiembroController::class, 'destroy'])->name('miembros.familia.destroy');
    Route::get('ajax/miembros/{value?}', [MiembroAjaxController::class, 'search'])->name('miembros.ajax.search');
    Route::get('miembros/exportar/excel', [MiembroExportController::class, 'excel'])->name('miembros.export.excel');
    Route::get('miembros/exportar/pdf', [MiembroExportController::class, 'pdf'])->name('miembros.export.pdf');
    Route::post('miembros/{miembro}/familia', [FamiliaMiembroController::class, 'store'])->name('miembros.familia.create');
    Route::resource('miembros', MiembroController::class);
    
    // Ministerios
    Route::delete('ministerios/{ministerio}/miembros', [MiembroMinisterioController::class, 'destroy'])->name('ministerios.miembro.destroy');
    Route::post('ministerios/{ministerio}/miembros', [MiembroMinisterioController::class, 'store'])->name('ministerios.miembro.store');
    Route::put('ministerios/{ministerio}/miembros', [MiembroMinisterioController::class, 'update'])->name('ministerios.miembro.update');
    Route::resource('ministerios', MinisterioController::class);
    
    // Eventos
    Route::resource('eventos', EventoController::class);
    
    // Escritorio
    Route::get('/', fn() => redirect()->route('escritorio.index'));
    Route::get('/escritorio', [EscritorioController::class, 'index'])->name('escritorio.index');
    
    // Visitas
    Route::resource('visitas', VisitaController::class);
    
    // Usuarios
    Route::resource('usuarios', UsuarioController::class);
    
    // Autenticado
    Route::get('cuenta/edit', [AutenticadoController::class, 'edit'])->name('autenticado.edit');
    Route::get('logout', [AutenticarController::class, 'logout'])->name('autenticar.logout');
    Route::match(['put','patch'], 'cuenta/edit', [AutenticadoController::class, 'update'])->name('autenticado.update');
});


// Invitado

Route::middleware(['web', 'guest'])->group(function () {
    Route::get('login', [AutenticarController::class, 'login'])->name('autenticar.login');
    Route::post('login', [AutenticarController::class, 'attempt'])->name('autenticar.attempt');
});
