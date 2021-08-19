<?php

namespace App;

use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Helper;

class ParteDiario extends Model
{
    protected $table = 'parte_diarios';

    protected $fillable = [
        'fecha', 'HoraEntrada', 'HoraSalida', 'TotalHoras', 'comida', 'almuerzo', 'merienda'
    ];

    protected $paginate = 15;

    public function getDateString(): string
    {
        $fecha = $this->dia . '-' . $this->mes . '-' . $this->year;
        return Carbon::createFromFormat('d-m-Y', $fecha)->format('d-m-Y');
    }
 /* Añadimos parte diario de trabajo a la base de datos */
    public function addUserForRequest($datos , $userId)
    {
        $this->userId = $userId;
        $this->fecha = date_create($datos->fecha);
        $this->HoraEntrada = $datos->hora_de_entrada;
        $this->HoraSalida = $datos->hora_de_salida;
        $this->almuerzo = $datos->almuerzo;
        $this->comida = $datos->comida;
        $this->merienda = $datos->merienda;
        $this->TotalHoras = Helper::calcularTotalHorasParteDiario($datos, User::find($userId)->configuracion);

        return $this->save();


    }

}
