<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\RequestAuth;
use App\Domain\Dto\ListadoPartesDto;
use App\Services\BuscarParteService;
use App\Services\ListadoPartesService;
use App\Models\Helper;


class ListadoPartesController extends Controller
{
    function ListadoPartes(RequestAuth $request, ListadoPartesService $listadoPartesService): JsonResponse
    {
        //TODO: En el front no se debe enviar el id del usuario, sino con el token vale
        $mes = !$request->mes ? Helper::getMesActual() : $request->mes;
        $year = Helper::getYearActual();

        $listadoPartesDiarios = $listadoPartesService->execute( ListadoPartesDto::create($request->id, $mes, $year) );


        return response()->json([
            'json' => $listadoPartesDiarios,
            'status' => 200,
        ]);
    }

    function verParte( $id, RequestAuth $request, BuscarParteService $buscarParteService): JsonResponse
    {

        try
        {
            $parte = $buscarParteService->execute($id, $request->id);

        } catch (\Exception $e ) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => '400',
            ],200);
        }

        return response()->json([
            'json' => $parte,
            'status' => 200
        ]);
    }
}
