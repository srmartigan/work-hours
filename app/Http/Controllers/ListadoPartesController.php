<?php

namespace App\Http\Controllers;

use App\Helper;
use App\ParteDiario;
use Illuminate\Http\Request;

class ListadoPartesController extends Controller
{

    function index()
    {
        ParteDiario::clearBootedModels();
        $parteDiario = ParteDiario::query()
            ->orderBy('fecha')
            ->paginate(15);

        Helper::dateFormatSpanish($parteDiario); // convert date "Y-m-d" to "d-m-Y"

        if (false) {
            return response()->json($parteDiario);
        }else {
            return view('app.listadoPartes')->with([
                'listadoDePartesDiario' => $parteDiario,
            ]);
        }
    }
}
