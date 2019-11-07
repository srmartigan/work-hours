<?php

namespace App\Http\Controllers;

use App\ParteDiario;
use Carbon\Carbon;
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
        $parteDiario->fecha = $request->dia;
        $parteDiario->HoraEntrada = $request->hora_de_entrada;
        $parteDiario->HoraSalida = $request->hora_de_salida;
        $parteDiario->TotalHoras = $this->calcularTotalHoras($request->hora_de_entrada, $request->hora_de_salida);
        $parteDiario->save();

        return view('app.inicio');
    }

    public function calendario()
    {
        $parteDiario = ParteDiario::all()->sortBy('fecha');

        return view('app.calendario')->with([
            'listadoDePartesDiario' => $parteDiario,
        ]);
    }


    protected function calcularTotalHoras(string $hora_de_entrada, string $hora_de_salida): string
    {
        if ($hora_de_entrada == null || $hora_de_salida == null) {
            return null;
        }

        $horaEntrada = Carbon::createFromTimeString($hora_de_entrada);
        $horaSalida = Carbon::createFromTimeString($hora_de_salida);
        $totalMinutos = Carbon::parse($horaSalida)->diffInMinutes($horaEntrada);

        $totalHoras = Carbon::createFromTimestamp($totalMinutos * 60)->format('H:i');

        return $totalHoras;

    }

}
