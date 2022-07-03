<?php

declare(strict_types=1);

namespace Tests\Unit\ParteDiario\Domain\ValueObjects;

use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioHoraSalida;
use PHPUnit\Framework\TestCase;

class ParteDiarioHoraSalidaTest extends TestCase
{
    public function test_hora_salida_debe_ser_un_string()
    {
        $horaEntrada = new ParteDiarioHoraSalida('08:00');

        $this->assertIsString($horaEntrada->value());
    }

    public function test_hora_salida_formato_debe_ser_hh_mm()
    {
        $horaEntrada = new ParteDiarioHoraSalida('08:00');

        $this->assertEquals('08:00', $horaEntrada->value());
    }

    public function test_hora_salida_formato_no_valido_lanza_throw_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Hora de salida debe ser de formato hh:mm');

        new ParteDiarioHoraSalida('8:00');
    }

    public function test_hora_salida_formato_no_valido_lanza_throw_exception_2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Hora de salida debe ser de formato hh:mm');

        new ParteDiarioHoraSalida('24:10');
    }

    public function test_hora_salida_formato_no_valido_lanza_throw_exception_3()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Hora de salida debe ser de formato hh:mm');

        new ParteDiarioHoraSalida('08:61');
    }
}
