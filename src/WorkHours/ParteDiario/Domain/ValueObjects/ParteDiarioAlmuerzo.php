<?php

declare(strict_types=1);

namespace Src\WorkHours\ParteDiario\Domain\ValueObjects;

use Src\WorkHours\ParteDiario\Domain\Exceptions\ExceptionDomainValueOutOfRange;

class ParteDiarioAlmuerzo
{
    private int $value;

    /**
     * @throws ExceptionDomainValueOutOfRange
     */
    public function __construct(int $value)
    {
        if (!$this->validar($value)) {
            throw new ExceptionDomainValueOutOfRange('El valor debe ser un número entero entre 0 y 1');
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    private function validar(int $value): bool
    {
        if ($value < 0 || $value > 1) {
            return false;
        }
        return true;
    }
}
