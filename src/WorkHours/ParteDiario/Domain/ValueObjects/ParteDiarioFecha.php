<?php

declare(strict_types=1);

namespace Src\WorkHours\ParteDiario\Domain\ValueObjects;

class ParteDiarioFecha
{
    private string $value;

    public function __construct(string $value)
    {
        if (!strtotime($value))
        {
            throw new \InvalidArgumentException('Invalid date format');
        }
        if(!date('d-m-Y', strtotime($value)))
        {
            throw new \InvalidArgumentException('Invalid date format');
        }

        $this->value = date('d-m-Y', strtotime($value));
    }

    public function value(): string
    {
        return $this->value;
    }

}
