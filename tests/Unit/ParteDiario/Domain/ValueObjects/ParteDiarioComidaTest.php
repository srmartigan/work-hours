<?php

namespace Tests\Unit\ParteDiario\Domain\ValueObjects;

use Src\WorkHours\ParteDiario\Domain\Exceptions\ExceptionDomainValueOutOfRange;
use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioComida;
use PHPUnit\Framework\TestCase;

class ParteDiarioComidaTest extends TestCase
{
    //Comida no seleccionado
    /**
     * @throws ExceptionDomainValueOutOfRange
     */
    public function test_Comida_False()
    {
        $dato = 0;
        $comida = new ParteDiarioComida($dato);

        $this->assertEquals(0, $comida->value());
    }

    //Comida seleccionado
    /**
     * @throws ExceptionDomainValueOutOfRange
     */
    public function test_Comida_True()
    {
        $dato = 1;
        $comida = new ParteDiarioComida($dato);

        $this->assertEquals(1, $comida->value());
    }

    //Comida datos fuera de rango
    /**
     * @throws ExceptionDomainValueOutOfRange
     */
    public function test_Comida_Out_Of_Range()
    {
        $dato = 2;
        $this->expectException(ExceptionDomainValueOutOfRange::class);
        $comida = new ParteDiarioComida($dato);
    }

    //Comida datos fuera de rango negativo
    /**
     * @throws ExceptionDomainValueOutOfRange
     */
    public function test_Comida_Out_Of_Range_Negative()
    {
        $dato = -1;
        $this->expectException(ExceptionDomainValueOutOfRange::class);
        $comida = new ParteDiarioComida($dato);
    }


}
