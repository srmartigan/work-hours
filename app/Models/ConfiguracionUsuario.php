<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionUsuario extends Model
{
    protected $table = 'configuracion_usuarios';

    public function getDescuento($tipo) : int
    {
        return $this->$tipo;
    }
}
