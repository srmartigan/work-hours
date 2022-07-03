<?php

namespace Tests\Unit\ParteDiario\Domain\ValueObjects;

use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioFecha;
use PHPUnit\Framework\TestCase;

class ParteDiarioFechaTest extends TestCase
{
    public function test_should_throw_exception_when_invalid_date_format()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid date format');

        new ParteDiarioFecha('fake date');
    }

    public function test_parteDiarioFecha_should_be_a_valid_date_format_ES()
    {
        $fecha = '01-01-2020';

        $this->assertEquals('01-01-2020', (new ParteDiarioFecha($fecha))->value());
    }

    public function test_parteDiarioFecha_should_be_a_valid_date_format_EN()
    {
        $fecha = '2020-01-01';

        $this->assertEquals('01-01-2020', (new ParteDiarioFecha($fecha))->value());

    }
}
