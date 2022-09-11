<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RequestAuth;
use App\Models\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestListadoPartes;
use App\Models\ParteDiario;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class ListadoPartesController extends Controller
{
    function ListadoPartes(RequestAuth $request): JsonResponse
    {
        //TODO: En el front no se debe enviar el id del usuario, sino con el token vale
        $mes = !$request->mes ? Helper::getMesActual() : $request->mes;
        $year = Helper::getYearActual();

        $listadoPartesDiarios = ParteDiario::query()
            ->where('userId','=',$request->id)
            ->whereMonth('fecha',$mes)
            ->whereYear('fecha',$year)
            ->orderBy('fecha')
            ->get();

        Helper::dateFormatSpanish($listadoPartesDiarios); // convert date "Y-m-d" to "d-m-Y"

        return response()->json([
            'json' => $listadoPartesDiarios->toArray(),
            'status' => 200,
        ]);
    }

    function verParte( $id, Request $request): JsonResponse
    {

        //Validar Toquen --------------------------
        $token = $request->header('token');

        $objectToken = Helper::autorizarToken($token);

        if (is_null($objectToken) || !isset($objectToken->id)) {
            return response()->json([
                'status' => 'error',  //'success'
                'code' => '401',
                'message' => 'error autorizacion'
            ],401);
        }
        //fin validar Toquen-------------------------

            $parte = ParteDiario::find($id);

        if (is_null($parte)){

            return response()->json([
                'message' => 'Parte no encontrado',
                'status' => '400',
                ],400);
        }

        return response()->json([
            'json' => $parte,
            'status' => 200
        ]);
    }
}
