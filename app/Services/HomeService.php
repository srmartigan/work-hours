<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\HomeDto;
use App\Helper;

class HomeService
{

    public function __construct()
    {
    }

    public function execute(HomeDto $datos): array
    {
        $listadoPartesDiario = Helper::queryListadoPartesDiarioApi(
            $datos->mes,
            $datos->year,
            $datos->id
        );
        $datos->totalHoras = Helper::sumarHorasNormales($listadoPartesDiario);
        $datos->total = Helper::calcularTotalPrecioNormalApi($datos->totalHoras,$datos->id);

        return $datos->datos();
    }
}
