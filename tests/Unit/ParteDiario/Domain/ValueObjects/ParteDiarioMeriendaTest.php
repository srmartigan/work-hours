<?php

namespace Tests\Unit\ParteDiario\Domain\ValueObjects;

use Src\WorkHours\ParteDiario\Domain\Exceptions\ExceptionDomainValueOutOfRange;
use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioMerienda;
use PHPUnit\Framework\TestCase;

class ParteDiarioMeriendaTest extends TestCase
{
    //Merienda no seleccionado
    /**
     * @throws ExceptionDomainValueOutOfRange
     */
    public function test_Merienda_False()
    {
        $dato = 0;
        $merienda = new ParteDiarioMerienda($dato);
        $this->assertEquals(0, $merienda->value());
    }

    //Merienda seleccionado
    /**
     * @throws ExceptionDomainValueOutOfRange
     */
    public function test_Merienda_True()
    {
        $dato = 1;
        $merienda = new ParteDiarioMerienda($dato);
        $this->assertEquals(1, $merienda->value());
    }

    //Merienda con valor fuera de rango
    /**
     * @throws ExceptionDomainValueOutOfRange
     */
    public function test_Merienda_Out_Of_Range()
    {
        $this->expectException(ExceptionDomainValueOutOfRange::class);
        $dato = 2;
        $merienda = new ParteDiarioMerienda($dato);
    }

    //Merienda con valor fuera de rango (negativo)
    /**
     * @throws ExceptionDomainValueOutOfRange
     */
    public function test_Merienda_Out_Of_Range_Negative()
    {
        $this->expectException(ExceptionDomainValueOutOfRange::class);
        $dato = -1;
        $merienda = new ParteDiarioMerienda($dato);
    }
}
