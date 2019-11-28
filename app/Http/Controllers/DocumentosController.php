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
        $listadoPartesDiarios = $this->queryListadoPartesDiario($mes);
        $totalHorasNormales = Helper::sumarHorasNormales($listadoPartesDiarios);
        $total = $this->calcularTotalPrecioNormal($totalHorasNormales);

        return view('app.documentos')->with([
            'listadoDePartesDiario' => $listadoPartesDiarios,
            'totalHoras' => $totalHorasNormales,
            'total' => $total
        ]);
    }

    // Lista de Partes Diarios del mes selecionado por usuario
    public function listarMes(Request $request)
    {
        $mes = (int)$request->mes;
        if (!$this->validateMes($mes)) {
            return redirect('/documentos');
        }
        $listadoPartesDiarios = $this->queryListadoPartesDiario($mes);
        $totalHorasNormales = Helper::sumarHorasNormales($listadoPartesDiarios);
        $total = $this->calcularTotalPrecioNormal($totalHorasNormales);
        return view('app.documentos')->with([
            'listadoDePartesDiario' => $listadoPartesDiarios,
            'totalHoras' => $totalHorasNormales,
            'total' => $total
        ]);
    }

    public function calcularTotalPrecioNormal($totalHorasNormales)
    {
        $configuracion = User::find(Auth::id())->configuracion;
        return number_format($totalHorasNormales * $configuracion->precio_hora, 2);
    }

    /**
     * @param int $mes
     * @return bool
     */
    public function validateMes(int $mes): bool
    {
        if (!is_int($mes)) {
            return false;
        }
        if ($mes < 1 || $mes > 12) {
            return false;
        }
        return true;
    }

    /**
     * @param int $mes
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function queryListadoPartesDiario(int $mes)
    {

        $listadoPartesDiario = ParteDiario::query()
            ->where('userId', '=', Auth::id())
            ->whereMonth('fecha', $mes)
            ->orderBy('fecha')
            ->paginate(31);

        Helper::dateFormatSpanish($listadoPartesDiario); // convert date "Y-m-d" to "d-m-Y"
        return $listadoPartesDiario;
    }

}
