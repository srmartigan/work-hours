<?php

namespace App\Http\Controllers;

use App\Helper;
use App\ParteDiario;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ParteDiarioController extends Controller
{
    public function index(): View
    {
        return view('app.formularioParteDiario');
    }

    public function incluir(Request $request): View
    {
        $parteDiario = new ParteDiario();
        $parteDiario->userId = 1;
        $parteDiario->fecha = $request->fecha;
        $parteDiario->HoraEntrada = $request->hora_de_entrada;
        $parteDiario->HoraSalida = $request->hora_de_salida;
        $parteDiario->TotalHoras = Helper::calcularTotalHoras($request->hora_de_entrada, $request->hora_de_salida);
        $parteDiario->almuerzo =$request->almuerzo;
        $parteDiario->comida = $request->comida;
        $parteDiario->merienda = $request->merienda;
        $parteDiario->save();

        return view('app.inicio');
    }

    public function editar(Request $request)
    {

    }

}
