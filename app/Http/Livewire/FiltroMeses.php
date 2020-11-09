<?php

namespace App\Http\Livewire;

use App\helper;
use App\ParteDiario;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class FiltroMeses extends Component
{
    use WithPagination;

    public $mes = null;

    public function render()
    {

        if ($this->mes == null){
            $this->mes = helper::getMesActual();
        }
        $listadoPartesDiario = helper::queryListadoPartesDiario($this->mes, helper::getYearActual());
        $totalHorasNormales = helper::sumarHorasNormales($listadoPartesDiario);
        $total = helper::calcularTotalPrecioNormal($totalHorasNormales);

        return view('livewire.filtro-meses')->with([
            'listadoPartesDiarios' => $listadoPartesDiario,
            'totalHorasNormales' => $totalHorasNormales,
            'total' => $total,
        ]);
    }


}
