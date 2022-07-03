<?php

declare(strict_types=1);

namespace Src\WorkHours\ParteDiario\Domain\ValueObjects;

class ParteDiarioHoraSalida
{
    private string $value;

    public function __construct(string $value)
    {
        if(!$this->validar($value)) {
            throw new \InvalidArgumentException('Hora de salida debe ser de formato hh:mm');
        }
        $this->value = date('H:i', strtotime($value));
    }

    public function value(): string
    {
        return $this->value;
    }

    public function validar($value): bool
    {
        if(!preg_match('/^(0\d|1\d]|2[0-3]):[0-5]\d$/', $value)) {
            return false;
        }
        return true;
    }
}
