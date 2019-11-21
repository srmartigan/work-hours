<?php

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

use App\Http\Controllers\ConfiguracionUsuariosController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\ListadoPartesController;
use App\Http\Controllers\ParteDiarioController;

Route::get('/', function () {
    return view('app.inicio');
});

// Rutas Documentos
Route::get('documentos',[DocumentosController::class,'index']);

// Rutas Parte diario
Route::get('parte-diario',[ParteDiarioController::class,'index']);
Route::post('incluir-parte-diario',[ParteDiarioController::class,'incluir']);

// Rutas Configuracion Systema
Route::get('configuracion-app', function () {
    return view('config.configuracion');
});

//Rutas Listado Partes
Route::get('listado-partes', [ListadoPartesController::class,'index']);
Route::post('listado-partes', [ListadoPartesController::class,'filtro']);

// Rutas configuracion Usuario
Route::get('configuracion-usuario', [ConfiguracionUsuariosController::class , 'index']);
Route::post('guardar-configuracion-usuario', [ConfiguracionUsuariosController::class , 'guardar']);

Auth::routes();


