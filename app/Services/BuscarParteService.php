<?php

namespace App\Services;

use App\Domain\ParteNotFoundException;
use App\Models\ParteDiario;
use Illuminate\Database\Eloquent\Model;

class BuscarParteService
{

    public function execute($idParte, $idUser): Model
    {
        $parte = ParteDiario::query()->where('id', $idParte)->where('userId', $idUser)->first();

        if (!$parte) {
            throw new ParteNotFoundException('Parte no encontrado');
        }

        return $parte;
    }
}
