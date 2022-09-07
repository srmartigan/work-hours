<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Dto\HomeDto;
use App\Helper;

class HomeService
{

    public function __construct()
    {
    }

    public function execute(HomeDto $homeData): array
    {
        $listadoPartesDiario = Helper::queryListadoPartesDiarioApi(
            $homeData->mes,
            $homeData->year,
            $homeData->id
        );
        $homeData->totalHoras = Helper::sumarHorasNormales($listadoPartesDiario);
        $homeData->total = Helper::calcularTotalPrecioNormalApi($homeData->totalHoras,$homeData->id);

        return $homeData->data();
    }
}
