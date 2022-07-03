<?php

declare(strict_types=1);

namespace Src\WorkHours\ParteDiario\Domain\ValueObjects;

class ParteDiarioId
{
    private string $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
