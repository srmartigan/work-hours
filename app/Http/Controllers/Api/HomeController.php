<?php

namespace App\Http\Controllers\Api;

use App\Domain\Dto\HomeDto;
use App\Models\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestAuth;
use App\Services\HomeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(RequestAuth $request, HomeService $homeService): JsonResponse
    {

        $id = $request['id'] ?? null;

        $mes = null;
        $request['mes'] == null ? $mes = Helper::getMesActual() : $mes = $request['mes'];

        $year = null;
        $request['year'] == null ? $year = Helper::getYearActual() : $year = $request['year'];


        $response = $homeService->execute(new HomeDto($id, '', '', $mes, $year));

        return response()->json([
            'totalHoras' => $response['totalHoras'],
            'total' => $response['total'],
            'mes' => $response['mes'],
            'year' => $response['year'],
        ], 200);

    }


}
