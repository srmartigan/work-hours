<?php

namespace App\Http\Controllers;

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
        //TODO: Refactorizar metodo esta en desarrollo
        if ($request->hora_de_entrada != null && $request->hora_de_salida != null) {
            $horaEntrada = Carbon::createFromTimeString($request->hora_de_entrada);
            $horaSalida = Carbon::createFromTimeString($request->hora_de_salida);
            $total_horas = Carbon::parse($horaSalida)->diffInMinutes($horaEntrada);


            $calendario = [
                'dia' => $request->dia,
                'hora_de_entrada' => $horaEntrada->format('H:i'),
                'hora_de_salida' => $horaSalida->format('H:i')
            ];

            return view('app.calendario')
                ->with([
                    'calendario' => $calendario,
                    'total_horas' => Carbon::createFromTimestamp($total_horas * 60)->format('H:i')
                ]);
        }
        $calendario = [
            'dia' => $request->dia,
            'hora_de_entrada' =>'',
            'hora_de_salida' => ''
        ];
        return view('app.calendario')
            ->with([
                'calendario' => $calendario,
                'total_horas' => ''
            ]);
    }
}
