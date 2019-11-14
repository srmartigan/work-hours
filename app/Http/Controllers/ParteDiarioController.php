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
        $fecha = $this->convertDateArray($request->dia);

        $parteDiario = new ParteDiario();
        $parteDiario->userId = 1;
        $parteDiario->dia = $fecha['dia'];
        $parteDiario->mes = $fecha['mes'];
        $parteDiario->year = $fecha['year'];
        $parteDiario->HoraEntrada = $request->hora_de_entrada;
        $parteDiario->HoraSalida = $request->hora_de_salida;
        $parteDiario->TotalHoras = $this->calcularTotalHoras($request->hora_de_entrada, $request->hora_de_salida);
        $parteDiario->save();

        return view('app.inicio');
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
    public function calendario()
    {
        ParteDiario::clearBootedModels();
        $parteDiario = ParteDiario::query()
            ->orderBy('year')
            ->orderBy('mes')
            ->paginate(15);

        //$this->dateFormatSpanish($parteDiario); // convert date "Y-m-d" to "d-m-Y"
        return response()->json($parteDiario);

        /*return view('app.calendario')->with([
            'listadoDePartesDiario' => $parteDiario,
        ]);*/
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



}
