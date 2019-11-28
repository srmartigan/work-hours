<?php


namespace App;


use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class helper
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

    public static function calcularTotalHorasParteDiario(Request $request, ConfiguracionUsuario $configuracion): string
    {
        $hora_de_entrada = $request->hora_de_entrada;
        $hora_de_salida = $request->hora_de_salida;

        if ($hora_de_entrada == null || $hora_de_salida == null) {
            return null;
        }

        $horaEntrada = Carbon::createFromTimeString($hora_de_entrada);
        $horaSalida = Carbon::createFromTimeString($hora_de_salida);
        $totalMinutos = Carbon::parse($horaSalida)->diffInMinutes($horaEntrada);

        if ($request->almuerzo) {
            $totalMinutos -= $configuracion->getDescuento('descuento_almuerzo');
        }
        if($request->comida) {
            $totalMinutos -= $configuracion->getDescuento('descuento_comida');
        }
        if($request->merienda) {
            $totalMinutos -= $configuracion->getDescuento('descuento_merienda');
        }

        $totalHoras = Carbon::createFromTimestamp($totalMinutos * 60)->format('H:i');

        return $totalHoras;
    }

    /**
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $parteDiario
     */
    public static function dateFormatSpanish($parteDiario): void
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

    public static  function getMesActual():string
    {
        $fechaActual = new DateTime();
        $mesActual = $fechaActual->format('m');
        return $mesActual;
    }

    public static function sumarHorasNormales($listadoPartesDiarios)
    {
        $tiempo=0;
        foreach ($listadoPartesDiarios as $partesDiario){
            $tiempo += self::convertirHoraEnMinutos(
                Carbon::createFromTimeString($partesDiario->TotalHoras)->format('H:i')
            );
        }
        return number_format($tiempo/60,2,'.','');
    }

    public static function convertirHoraEnMinutos(string $hora) : int {

        $horaTroceada = explode(':',$hora);
        $minutosTotales = ($horaTroceada[0] * 60) + $horaTroceada[1];
        return $minutosTotales;
    }
}
