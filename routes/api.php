<?php

use App\Http\Controllers\api\ListadoPartesController;
use Illuminate\Http\Request;


use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ParteDiarioController;
use App\Http\Controllers\Api\RegisterController;


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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/parte_diario_add', [ParteDiarioController::class , 'incluir']);
Route::post('/listado_partes' , [ListadoPartesController::class , 'ListadoPartes']);
Route::post('/login', [LoginController::class, 'index']);
Route::post('/register', [RegisterController::class, 'index']);
