<?php

declare(strict_types=1);

namespace Src\WorkHours\ParteDiario\Domain\ValueObjects;

use Src\WorkHours\ParteDiario\Domain\Exceptions\ExceptionDomainMinorZero;

class ParteDiarioId
{
    private int $value;

    /**
     * @throws ExceptionDomainMinorZero
     */
    public function __construct(int $value)
    {
        if (!$this->validar($value)) {
            throw new ExceptionDomainMinorZero();
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function validar($value): bool
    {
        if ($value < 0) {
            return false;
        }
        return true;
    }
}
