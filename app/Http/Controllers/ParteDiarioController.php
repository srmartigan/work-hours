<?php

namespace App\Http\Controllers;

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
        $parteDiario->TotalHoras = $this->calcularTotalHoras($request->hora_de_entrada, $request->hora_de_salida);
        $parteDiario->save();

        return view('app.inicio');
    }

    public function calendario()
    {
        ParteDiario::clearBootedModels();
        $parteDiario = ParteDiario::query()
            ->orderBy('fecha')
            ->paginate(15);

        $this->dateFormatSpanish($parteDiario); // convert date "Y-m-d" to "d-m-Y"
        $this->calcularTotalHorasAll($parteDiario);

        if (false) {
            return response()->json($parteDiario);
        }else {
            return view('app.calendario')->with([
                'listadoDePartesDiario' => $parteDiario,
            ]);
        }
    }

    protected function calcularTotalHorasAll($parteDiario)
    {
        foreach ($parteDiario as $parte) {
            $parte->TotalHoras = $this->calcularTotalHoras($parte->HoraEntrada,$parte->HoraSalida);
        }
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

    /**
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $parteDiario
     */
    public function dateFormatSpanish(LengthAwarePaginator $parteDiario): void
    {
        foreach ($parteDiario as $parte) {
            $parte->fecha = DateTime::createFromFormat('Y-m-d', $parte->fecha)->format('d-m-Y');
        }
    }

    /**
     * @param String $fecha
     * @return mixed
     */
    public function convertDateArray(String $fecha) : Array
    {
        $CarbonFecha = Carbon::createFromFormat('Y-m-d',$fecha);
        $resultado = [
            'dia' => $CarbonFecha->day,
            'mes' => $CarbonFecha->month,
            'year' => $CarbonFecha->year
        ];
        return $resultado;
    }



}
