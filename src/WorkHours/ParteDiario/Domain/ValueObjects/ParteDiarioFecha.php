<?php

declare(strict_types=1);

namespace Src\WorkHours\ParteDiario\Domain\ValueObjects;

class ParteDiarioFecha
{
    private string $value;

    public function __construct(string $value)
    {
        if(!preg_match('/^([012][1-9]|3[01])(\-)(0[1-9]|1[012])\2(\d{4})$/', $value) && !preg_match('/^(\d{4})-(0\d|1[012])-(0\d|1\d|2\d|3[0-1])$/', $value)) {
            throw new \InvalidArgumentException('Invalid date format');
        }

        $this->value = date('d-m-Y', strtotime($value));
    }

    public function value(): string
    {
        return $this->value;
    }

}
