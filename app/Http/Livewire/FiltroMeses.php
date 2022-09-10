<?php

namespace App\Http\Livewire;

use App\Models\Helper;
use App\Models\ParteDiario;
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
            $this->mes = Helper::getMesActual();
        }
        $listadoPartesDiario = Helper::queryListadoPartesDiario($this->mes, Helper::getYearActual());
        $totalHorasNormales = Helper::sumarHorasNormales($listadoPartesDiario);
        $total = Helper::calcularTotalPrecioNormal($totalHorasNormales);

        return view('livewire.filtro-meses')->with([
            'listadoPartesDiarios' => $listadoPartesDiario,
            'totalHorasNormales' => $totalHorasNormales,
            'total' => $total,
        ]);
    }


}
