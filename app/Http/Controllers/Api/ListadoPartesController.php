<?php

namespace App\Http\Controllers\api;

use App\Helper;
use App\Http\Controllers\Controller;
use App\ParteDiario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListadoPartesController extends Controller
{
    function ListadoPartes(Request $request)
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

        ParteDiario::clearBootedModels();
        $mesActual = Helper::getMesActual();
        $year = Helper::getYearActual();

        $listadoPartesDiarios = ParteDiario::query()
            ->where('userId','=',$request->id)
            ->whereMonth('fecha',$mesActual)
            ->whereYear('fecha',$year)
            ->orderBy('fecha')
            ->get();

        Helper::dateFormatSpanish($listadoPartesDiarios); // convert date "Y-m-d" to "d-m-Y"

        return response()->json([
            'listado' => $listadoPartesDiarios,
            'status' => 200,
        ]);
    }
}
