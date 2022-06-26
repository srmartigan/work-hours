<?php


namespace App\Models;


use Carbon\Carbon;
use DateTime;
use DomainException;
use Firebase\JWT\JWT;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use UnexpectedValueException;

class Helper
{
    public static function calcularTotalHoras(string $hora_de_entrada, string $hora_de_salida): ?string
    {
        if ($hora_de_entrada == null || $hora_de_salida == null) {
            return null;
        }

        $horaEntrada = Carbon::createFromTimeString($hora_de_entrada);
        $horaSalida = Carbon::createFromTimeString($hora_de_salida);
        $totalMinutos = Carbon::parse($horaSalida)->diffInMinutes($horaEntrada);

        return Carbon::createFromTimestamp($totalMinutos * 60)->format('H:i');
    }

    public static function calcularTotalHorasParteDiario( $request, ConfiguracionUsuario $configuracion): ?string
    {

        $hora_de_entrada = $request->HoraEntrada;
        $hora_de_salida = $request->HoraSalida;

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
        return [
            'dia' => $CarbonFecha->day,
            'mes' => $CarbonFecha->month,
            'year' => $CarbonFecha->year
        ];
    }

    public static  function getMesActual():string
    {
        $fechaActual = new DateTime();
        return $fechaActual->format('m');
    }

    public static  function getYearActual():string
    {
        $fechaActual = new DateTime();
        $yearActual = "20".$fechaActual->format('y');
        return $yearActual;
    }


    public static function sumarHorasNormales($listadoPartesDiarios): string
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
        return ((int)$horaTroceada[0] * 60) + (int)$horaTroceada[1];
    }

    public static function calcularTotalPrecioNormal($totalHorasNormales): string
    {
        $configuracion = User::find(Auth::id())->configuracion;
        return number_format($totalHorasNormales * $configuracion->precio_hora, 2);
    }

    public static function calcularTotalPrecioNormalApi($totalHorasNormales, int $userId): string
    {
        $configuracion = User::find($userId)->configuracion;
        return number_format($totalHorasNormales * $configuracion->precio_hora, 2);
    }

    public static function queryListadoPartesDiario(int $mes , int $year): LengthAwarePaginator
    {

        $listadoPartesDiario = ParteDiario::query()
            ->where('userId', '=', Auth::id())
            ->whereMonth('fecha', $mes)
            ->whereYear('fecha', $year)
            ->orderBy('fecha')
            ->paginate(31);

        Helper::dateFormatSpanish($listadoPartesDiario); // convert date "Y-m-d" to "d-m-Y"
        return $listadoPartesDiario;
    }

    public static function queryListadoPartesDiarioApi(int $mes , int $year, int $userId): Collection
    {

        $listadoPartesDiario = ParteDiario::query()
            ->where('userId', '=', $userId)
            ->whereMonth('fecha', $mes)
            ->whereYear('fecha', $year)
            ->orderBy('fecha')
            ->get();


        Helper::dateFormatSpanish($listadoPartesDiario); // convert date "Y-m-d" to "d-m-Y"
        return $listadoPartesDiario;
    }

    public static function validateMes(int $mes): bool
    {
        if (!is_int($mes)) {
            return false;
        }
        if ($mes < 1 || $mes > 12) {
            return false;
        }
        return true;
    }

    public static function crearToken(User $user): string
    {
        $payload = array(
            "id" => $user->id,
            "email" => $user->email,
            "rol" => "usuario",
            "iat" => 1356999524,
            "nbf" => 1357000000
        );

        return JWT::encode($payload, env('TOKEN_KEY'));
    }

    public static function autorizarToken($token): ?object
    {
        try {
            $decoded = JWT::decode($token, env('TOKEN_KEY'), array('HS256'));

            if (is_object($decoded) && isset($decoded->id) && isset($decoded->email)) {
                return $decoded;
            }
        } catch (UnexpectedValueException | DomainException $e) {
            return null;
        }

        return null;
    }

    public static function validarToken($request): ?object
    {
        //Validar Toquen --------------------------
        $token = $request->header('token');

        $objectToken = Helper::autorizarToken($token);
        if (is_null($objectToken) || !isset($objectToken->id)) {
            return response()->json([
                'status' => 'error',
                'code' => '401',
                'message' => 'error autorizacion'
            ],401);
        }
        //fin validar Toquen-------------------------

        return $objectToken;
    }


}
