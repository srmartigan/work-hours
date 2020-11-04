<?php

namespace App\Http\Controllers;

use App\Helper;
use App\ParteDiario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListadoPartesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        ParteDiario::clearBootedModels();
        $mesActual = Helper::getMesActual();
        $year = Helper::getYearActual();

        $parteDiario = ParteDiario::query()
            ->where('userId','=',Auth::id())
            ->whereMonth('fecha',$mesActual)
            ->whereYear('fecha',$year)
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

    function filtro(Request $request)
    {
        $year = helper::getYearActual();
        $parteDiario = ParteDiario::query()
            ->where('userId','=',Auth::id())
            ->whereMonth('fecha',$request->filtroMes)
            ->whereYear('fecha',$year)
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
