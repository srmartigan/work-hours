<?php

declare(strict_types=1);

namespace Src\WorkHours\ParteDiario\Domain\ValueObjects;

class ParteDiarioHoraEntrada
{
    private string $value;

    public function __construct(string $value)
    {
        if(!preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/', $value)) {
            throw new \InvalidArgumentException('Hora de entrada deve ser no formato hh:mm');
        }
        $this->value = date('H:i', strtotime($value));
    }

    public function value(): string
    {
        return $this->value;
    }
}
