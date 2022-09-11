<?php

namespace App\Services;

use App\Domain\Dto\ListadoPartesDto;
use App\Models\Helper;
use App\Models\ParteDiario;

class ListadoPartesService
{
    public function execute(ListadoPartesDto $listadoPartesDto): array
    {

        $listadoPartesDiarios = ParteDiario::query()
            ->where('userId','=',$listadoPartesDto->id())
            ->whereMonth('fecha',$listadoPartesDto->mes())
            ->whereYear('fecha',$listadoPartesDto->year())
            ->orderBy('fecha')
            ->get();

        Helper::dateFormatSpanish($listadoPartesDiarios); // convert date "Y-m-d" to "d-m-Y"

        return $listadoPartesDiarios->toArray();
    }
}
