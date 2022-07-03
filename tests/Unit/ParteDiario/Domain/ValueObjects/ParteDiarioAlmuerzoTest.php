<?php

namespace Tests\Unit\ParteDiario\Domain\ValueObjects;

use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioAlmuerzo;
use PHPUnit\Framework\TestCase;

class ParteDiarioAlmuerzoTest extends TestCase
{

    //Almuerzo no seleccionado
    /**
     * @throws \Src\WorkHours\ParteDiario\Domain\Exceptions\ExceptionDomainValueOutOfRange
     */
    public function testAlmuerzoFalse()
    {
        $dato = 0;
        $almuerzo = new ParteDiarioAlmuerzo($dato);
        $this->assertEquals(0, $almuerzo->value());
    }

    //Almuerzo seleccionado

    /**
     * @throws \Src\WorkHours\ParteDiario\Domain\Exceptions\ExceptionDomainValueOutOfRange
     */
    public function testAlmuerzoTrue()
    {
        $dato = 1;
        $almuerzo = new ParteDiarioAlmuerzo($dato);
        $this->assertEquals(1, $almuerzo->value());
    }

    //Datos fuera de rango
    /**
     * @throws \Src\WorkHours\ParteDiario\Domain\Exceptions\ExceptionDomainValueOutOfRange
     */
    public function testAlmuerzoOutOfRange()
    {
        $dato = 2;
        $this->expectException(\Exception::class);
        $almuerzo = new ParteDiarioAlmuerzo($dato);
    }

    //Datos fuera de rango negativos
    /**
     * @throws \Src\WorkHours\ParteDiario\Domain\Exceptions\ExceptionDomainValueOutOfRange
     */
    public function testAlmuerzoOutOfRangeNegative()
    {
        $dato = -1;
        $this->expectException(\Exception::class);
        $almuerzo = new ParteDiarioAlmuerzo($dato);
    }
}
