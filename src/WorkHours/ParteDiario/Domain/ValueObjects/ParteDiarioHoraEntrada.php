<?php

declare(strict_types=1);

namespace Src\WorkHours\ParteDiario\Domain\ValueObjects;

class ParteDiarioHoraEntrada
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = date('H:i', strtotime($value));
    }

    public function value(): string
    {
        return $this->value;
    }
}
