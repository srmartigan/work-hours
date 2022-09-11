<?php

namespace App\Domain\Dto;

class ListadoPartesDto
{
    private int $id;
    private int $mes;
    private int $year;

    private function __construct(int $id, int $mes, int $year)
    {
        $this->id = $id;
        $this->mes = $mes;
        $this->year = $year;
    }

    public static function create(int $id, int $mes, int $year): self
    {
        return new self($id, $mes, $year);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function mes(): int
    {
        return $this->mes;
    }

    public function year(): int
    {
        return $this->year;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'mes' => $this->mes,
            'year' => $this->year
        ];
    }
}
