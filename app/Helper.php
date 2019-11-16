<?php


namespace App;


use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Helper
{
    public static function calcularTotalHoras(string $hora_de_entrada, string $hora_de_salida): string
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
    public static function dateFormatSpanish(LengthAwarePaginator $parteDiario): void
    {
        foreach ($parteDiario as $parte) {
            $parte->fecha = DateTime::createFromFormat('Y-m-d', $parte->fecha)->format('d-m-Y');
        }
    }

    /**
     * @param String $fecha
     * @return mixed
     */
    public static function convertDateArray(String $fecha) : Array
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
