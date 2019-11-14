<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParteDiario extends Model
{
    protected $table = 'parte_diarios';

    protected $fillable = [
        'fecha','HoraEntrada', 'HoraSalida', 'TotalHoras',
    ];

    protected $paginate = 15;

}
