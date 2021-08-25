<?php

namespace App\Http\Controllers\Api;

use App\Helper;
use App\Http\Controllers\Controller;
use App\ParteDiario;
use App\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParteDiarioController extends Controller
{
    public function incluir(Request $request)
    {
        //Validar Toquen --------------------------
        $token = $request->header('token');

        $objectToken = Helper::autorizarToken($token);
        if (is_null($objectToken) || !isset($objectToken->id)) {
            return response([
                'status' => 'error',  //'success'
                'code' => '401',
                'message' => 'error autorizacion'
            ]);
        }
        //fin validar Toquen-------------------------
        $datos = json_decode($request->json);
        if (!isset($datos->fecha) || !isset($datos->hora_de_entrada) || !isset($datos->hora_de_salida)
            || !isset($datos->almuerzo) || !isset($datos->comida) || !isset($datos->merienda)) {
            $request->validate([

            ]);
            return response([
                'status' => 'error',
                'code' => '401',
                'message' => 'faltan datos o son incorrectos'
            ]);
        }


        try {
            $parteDiario = new ParteDiario();
            $userId = $objectToken->id;
            $parteDiario->addUserForRequest($datos, $userId);

        } catch (\exception $e) {
            return response(['status' => 'error',
                'code' => '401',
                'message' => 'error al añadir parte diario']);
        }


        return response([
            'status' => 'success',
            'code' => '200',
            'message' => 'creado correctamente'
        ]);
    }
}
