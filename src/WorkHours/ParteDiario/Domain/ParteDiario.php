<?php

declare(strict_types=1);

namespace Src\WorkHours\ParteDiario\Domain;

use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioAlmuerzo;
use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioComida;
use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioFecha;
use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioHoraEntrada;
use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioHoraSalida;
use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioId;
use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioMerienda;
use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioTotalHoras;
use Src\WorkHours\User\Domain\ValueObjects\UserId;

class ParteDiario
{

    public function __construct(
        ParteDiarioId $parteDiarioId,
        UserId $userId,
        ParteDiarioFecha $fecha,
        ParteDiarioHoraEntrada $horaEntrada,
        ParteDiarioHoraSalida $horaSalida,
        ParteDiarioTotalHoras $totalHoras,
        ParteDiarioAlmuerzo $almuerzo,
        ParteDiarioComida $comida,
        ParteDiarioMerienda $merienda
    ) {}

    public function ParteDiarioId(): ParteDiarioId
    {
        return new ParteDiarioId($this->parteDiarioId);
    }

}
