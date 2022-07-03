<?php

namespace Tests\Unit\ParteDiario\Domain\ValueObjects;

use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioHoraEntrada;
use PHPUnit\Framework\TestCase;

class ParteDiarioHoraEntradaTest extends TestCase
{
    public function test_hora_entrada_debe_ser_un_string()
    {
        $horaEntrada = new ParteDiarioHoraEntrada('08:00');

        $this->assertIsString($horaEntrada->value());
    }

    public function test_hora_entrada_formato_debe_ser_hh_mm()
    {
        $horaEntrada = new ParteDiarioHoraEntrada('08:00');

        $this->assertEquals('08:00', $horaEntrada->value());
    }

    public function test_hora_entrada_formato_no_valido_lanza_throw_exception()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Hora de entrada deve ser no formato hh:mm');

        new ParteDiarioHoraEntrada('8:00');
    }

    public function test_hora_entrada_formato_no_valido_lanza_throw_exception_2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Hora de entrada deve ser no formato hh:mm');

        new ParteDiarioHoraEntrada('24:10');
    }

    public function test_hora_entrada_formato_no_valido_lanza_throw_exception_3()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Hora de entrada deve ser no formato hh:mm');

        new ParteDiarioHoraEntrada('08:61');
    }
}
