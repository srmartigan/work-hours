<?php

namespace App;

use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Helper;

class ParteDiario extends Model
{
    use HasFactory;
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
    public function addUserForRequest($datos , $userId): bool
    {
        $this->userId = $userId;
        $this->fecha = date_create($datos->fecha);
        $this->HoraEntrada = $datos->HoraEntrada;
        $this->HoraSalida = $datos->HoraSalida;
        $this->almuerzo = $datos->almuerzo;
        $this->comida = $datos->comida;
        $this->merienda = $datos->merienda;
        $this->TotalHoras = Helper::calcularTotalHorasParteDiario($datos, User::find($userId)->configuracion);

        return $this->save();


    }

    public function editarParte($datos)
    {
        $parte = ParteDiario::find($datos->id);

        $parte->fecha = date_create($datos->fecha);
        $parte->HoraEntrada = $datos->HoraEntrada;
        $parte->HoraSalida = $datos->HoraSalida;
        $parte->almuerzo = $datos->almuerzo;
        $parte->comida = $datos->comida;
        $parte->merienda = $datos->merienda;
        $parte->TotalHoras = Helper::calcularTotalHorasParteDiario($datos, User::find($datos->userId)->configuracion);

        $parte->save();

    }

}
