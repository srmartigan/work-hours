<?php

use App\Http\Controllers\Api\ConfiguracionController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ListadoPartesController;

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

Route::post('/home',                     [HomeController         ::class, 'home'      ]);
Route::post('/verConfiguracion',         [ConfiguracionController::class, 'verConfiguracion']);
Route::post('/guardarConfiguracion',     [ConfiguracionController::class, 'guardarConfiguracion']);


Route::post('/parte_diario_add',         [ParteDiarioController  ::class, 'incluir'      ]);
Route::post('/parte_diario_edit',        [ParteDiarioController  ::class, 'editar'       ]);
Route::post('/parte_diario_delete/{id}', [ParteDiarioController  ::class, 'borrar'       ]);

Route::post('/listado_partes',           [ListadoPartesController::class, 'ListadoPartes']);
Route::post('/ver-parte/{id}',           [ListadoPartesController::class, 'verParte'     ]);

Route::post('/login',                    [LoginController        ::class, 'index'        ]);
Route::post('/register',                 [RegisterController     ::class, 'index'        ]);
