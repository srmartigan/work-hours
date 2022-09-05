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

        $objectToken = Helper::validarToken($request);

        $mes = null;
        $request->mes == null ? $mes = Helper::getMesActual() : $mes = $request->mes;

        $year = null;
        $request->year == null ? $year = Helper::getYearActual() : $year = $request->year;


        $response = $homeService->execute(new HomeDto($objectToken->id, '', '', $mes, $year));

        return response()->json([
            'totalHoras' => $response['totalHoras'],
            'total' => $response['total'],
            'mes' => $response['mes'],
            'year' => $response['year'],
        ], 200);

    }
}
