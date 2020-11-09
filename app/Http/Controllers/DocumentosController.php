<?php

namespace App\Http\Controllers;

use App\Helper;
use App\ParteDiario;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Lista de Partes Diario del mes activo.
    public function index()
    {
        $mes = Helper::getMesActual();
        $year = Helper::getYearActual();

        $listadoPartesDiarios = Helper::queryListadoPartesDiario($mes, $year);
        $totalHorasNormales = Helper::sumarHorasNormales($listadoPartesDiarios);
        $total = Helper::calcularTotalPrecioNormal($totalHorasNormales);

        return view('app.documentos')->with([
            'listadoPartesDiarios' => $listadoPartesDiarios,
            'totalHorasNormales' => $totalHorasNormales,
            'total' => $total
        ]);
    }

    // Lista de Partes Diarios del mes selecionado por usuario
    public function listarMes(Request $request)
    {
        $mes = (int)$request->mes;
        $year = helper::getYearActual();
        if (!Helper::validateMes($mes)) {
            return redirect('/documentos');
        }
        $listadoPartesDiarios = Helper::queryListadoPartesDiario($mes, $year);
        $totalHorasNormales = Helper::sumarHorasNormales($listadoPartesDiarios);
        $total = Helper::calcularTotalPrecioNormal($totalHorasNormales);
        return view('app.documentos')->with([
            'listadoPartesDiario' => $listadoPartesDiarios,
            'totalHorasNormales' => $totalHorasNormales,
            'total' => $total
        ]);
    }

}
