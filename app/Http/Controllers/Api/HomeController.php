<?php

namespace App\Http\Controllers\api;

use App\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        //Validar Toquen --------------------------
        $token = $request->header('token');

        $objectToken = Helper::autorizarToken($token);
        if (is_null($objectToken) || !isset($objectToken->id)) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'error autorizacion'
            ],401);
        }
        //fin validar Toquen-------------------------

        $listadoPartesDiario = Helper::queryListadoPartesDiarioApi(
            Helper::getMesActual(),
            Helper::getYearActual(),
            $objectToken->id
        );
        $totalHorasNormales = Helper::sumarHorasNormales($listadoPartesDiario);
        $total = Helper::calcularTotalPrecioNormalApi($totalHorasNormales,$objectToken->id);

        return response()->json([
            'totalHoras' => $totalHorasNormales,
            'total' => $total,
            'mes' => Helper::getMesActual(),
            'year' => Helper::getYearActual()
        ],200);

    }
}
