<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ParteDiario extends Model
{
    protected $table = 'parte_diarios';

    protected $fillable = [
        'fecha', 'HoraEntrada', 'HoraSalida', 'TotalHoras', 'comida', 'almuerzo','merienda'
    ];

    protected $paginate = 15;

    public function getDateString() : String
    {
        $fecha = $this->dia .'-'. $this->mes .'-'. $this->year;
        return Carbon::createFromFormat('d-m-Y', $fecha)->format('d-m-Y');
    }

}
