<?php

namespace App\Models;

use App\Domain\RegisterNotFoundException;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionUsuario extends Model
{
    protected $table = 'configuracion_usuarios';

    protected $fillable = [
        'userId',
        'descuento_almuerzo',
        'descuento_comida',
        'descuento_merienda',
        'precio_hora',
        'precio_hora_estructurada',
        'precio_hora_extra'
    ];

    public function getDescuento($tipo) : int
    {
        return $this->$tipo;
    }

    public function create(int $userId) : void
    {
        //validar que el usuario no tenga configuracion
        if (ConfiguracionUsuario::query()->where('userId', $userId)->exists()) {
            throw new RegisterNotFoundException('El usuario ya tiene configuracion');
        }

        //crear configuracion por defecto
        $this->userId = $userId;
        $this->descuento_almuerzo = 0;
        $this->descuento_comida = 0;
        $this->descuento_merienda = 0;
        $this->precio_hora = 0;
        $this->precio_hora_estructurada = 0;
        $this->precio_hora_extra = 0;
        $this->save();
    }

}
