<?php

use App\Http\Controllers\ApiEventoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('cors')->group(function () {
//     Route::get('eventos/{numero_mes?}', [ApiEventoController::class, 'index'])->name('api.eventos.index');
// });

Route::get('eventos/{anio}/{mes}', [ApiEventoController::class, 'index'])->name('api.eventos.index');
