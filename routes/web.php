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

use App\Http\Controllers\ParteDiarioController;

Route::get('/', function () {
    return view('app.inicio');
});
Route::get('documentos', function () {
    return view('app.documentos');
});


Route::get('parte-diario',[ParteDiarioController::class,'index']);

Route::post('incluir-parte-diario',[ParteDiarioController::class,'incluir']);

Route::get('configuracion-app', function () {
    return view('config.configuracion');
});

Route::get('calendario', [ParteDiarioController::class,'incluir']);
