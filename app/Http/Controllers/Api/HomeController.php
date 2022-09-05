<?php

namespace App\Http\Controllers\Api;

use App\Domain\HomeDto;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Services\HomeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(Request $request, HomeService $homeService)
    {

        //Validar Toquen --------------------------

        $token = $request->header('token');
        if ($token == null) {
            return new JsonResponse(['error' => 'Token no encontrado'], 401);
        }


        $objectToken = Helper::autorizarToken($token);
        if (is_null($objectToken) || !isset($objectToken->id)) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'error autorizacion'
            ],401);
        }
        //fin validar Toquen-------------------------

        if($request->mes == null){
            $mes = Helper::getMesActual();
        }else{
            $mes = $request->mes;
        }
        $response = $homeService->execute(new HomeDto($objectToken->id,'','',$mes,2022));

//        $listadoPartesDiario = Helper::queryListadoPartesDiarioApi(
//            $mes,
//            Helper::getYearActual(),
//            $objectToken->id
//        );
//        $totalHorasNormales = Helper::sumarHorasNormales($listadoPartesDiario);
//        $total = Helper::calcularTotalPrecioNormalApi($totalHorasNormales,$objectToken->id);


        return response()->json([
            'totalHoras' => $response['totalHoras'],
            'total' => $response['total'],
            'mes' => $response['mes'],
            'year' => $response['year'],
        ],200);

    }
}
