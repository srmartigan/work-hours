<?php

namespace App\Http\Controllers\Api;

use App\Models\Helper;
use App\Http\Controllers\Controller;
use App\Models\ParteDiario;
use App\Models\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParteDiarioController extends Controller
{
    private function validarToken($token)
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

    public function incluir(Request $request)
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

        $datos = json_decode($request->json);
        if (!isset($datos->fecha) || !isset($datos->HoraEntrada) || !isset($datos->HoraSalida)
            || !isset($datos->almuerzo) || !isset($datos->comida) || !isset($datos->merienda)) {

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

    function editar(Request $request)
    {
        $token = $request->header('token');
        $objectToken = $this->validarToken($token);

        $datos = json_decode($request->json);

        if (!isset($datos->fecha) || !isset($datos->id) || !isset($datos->HoraEntrada) || !isset($datos->HoraSalida)
            || !isset($datos->almuerzo) || !isset($datos->comida) || !isset($datos->merienda)) {

            return response([
                'status' => 'error',
                'code' => '401',
                'message' => 'faltan datos o son incorrectos'
            ]);
        }

        try {
            $parteDiario = new ParteDiario();
            $userId = $objectToken->id;
            $parteDiario->editarParte($datos);

        } catch (\exception $e) {
            return response(['status' => 'error',
                'code' => '401',
                'message' => 'error al editar parte diario']);
        }


        return response()->json([
           'json' => 'correcto',
           'status' => 200
        ]);
    }

    function borrar(Request $request, $id)
    {
        $token = $request->header('token');
        $objectToken = $this->validarToken($token);

        $parte = ParteDiario::find($id);

        $parte->delete();

        return response()->json([
           'json' => 'parte '.$id.' Eliminado correctamente',
           'status' => 200
        ]);

    }
}
