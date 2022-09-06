<?php

namespace App\Domain;

class HomeDto
{
    public int $id;
    public  string $totalHoras;
    public string $total;
    public int $mes;
    public int $year;

    public function __construct(int $id, string $totalHoras, string $total, int $mes, int $year)
    {
        $this->id = $id;
        $this->totalHoras = $totalHoras;
        $this->total = $total;
        $this->mes = $mes;
        $this->year = $year;
    }

    public function data() : array
    {
        return [
            'totalHoras' => $this->totalHoras,
            'total' => $this->total,
            'mes' => $this->mes,
            'year' => $this->year
        ];
    }
}
