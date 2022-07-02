<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Helper;
use App\Models\ParteDiario;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ParteDiarioController extends Controller
{
    private function validarToken($token): object
    {
        $objectToken = Helper::autorizarToken($token);
        if (is_null($objectToken) || !isset($objectToken->id)) {
            return response()->json([
                'status' => 'error',  //'success'
                'code' => '401',
                'message' => 'error autorizacion'
            ]);
        }

        return $objectToken;
    }

    public function incluir(Request $request) : JsonResponse
    {
//        //Validar Toquen --------------------------
//        $token = $request->header('token');
//
//        $objectToken = Helper::autorizarToken($token);
//        if (is_null($objectToken) || !isset($objectToken->id)) {
//            return response()->json([
//                'status' => 'error',  //'success'
//                'code' => '401',
//                'message' => 'error autorizacion'
//            ]);
//        }
//        //fin validar Toquen-------------------------

        $token = $request->header('token');
        $objectToken = $this->validarToken($token);

        $datos = json_decode($request['json']);
        if (!isset($datos->fecha) || !isset($datos->HoraEntrada) || !isset($datos->HoraSalida)
            || !isset($datos->almuerzo) || !isset($datos->comida) || !isset($datos->merienda)) {

            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'faltan datos o son incorrectos'
            ]);
        }

        try {
            $parteDiario = new ParteDiario();
            $userId = $objectToken->id;
            $parteDiario->addUserForRequest($datos, $userId);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'error al añadir parte diario'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'code' => '200',
            'message' => 'creado correctamente'
        ]);
    }

    function editar(Request $request) : JsonResponse
    {
        $token = $request->header('token');
        $objectToken = $this->validarToken($token);

        $datos = json_decode($request->json);

        if (!isset($datos->fecha) || !isset($datos->id) || !isset($datos->HoraEntrada) || !isset($datos->HoraSalida)
            || !isset($datos->almuerzo) || !isset($datos->comida) || !isset($datos->merienda)) {

            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'faltan datos o son incorrectos'
            ]);
        }

        try {
            $parteDiario = new ParteDiario();
            $userId = $objectToken->id;
            $parteDiario->editarParte($datos);

        } catch (exception $e) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'error al editar parte diario'
            ]);
        }

        return response()->json([
            'json' => 'correcto',
            'status' => 200
        ]);
    }

    function borrar(Request $request, $id) : JsonResponse
    {
        $token = $request->header('token');
        $this->validarToken($token);

        $parte = ParteDiario::query()->find($id);
        if (is_null($parte)) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'no existe el parte diario'
            ]);
        }

        $parte->delete();

        return response()->json([
            'json' => 'parte ' . $id . ' Eliminado correctamente',
            'status' => 200
        ]);

    }
}
