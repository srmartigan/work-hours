<?php

namespace Tests\Unit\ParteDiario\Domain\ValueObjects;

use Src\WorkHours\ParteDiario\Domain\ValueObjects\ParteDiarioId;
use PHPUnit\Framework\TestCase;

class ParteDiarioIdTest extends TestCase
{
    public function test_Id_Success()
    {
        $dato = 1;
        $id = new ParteDiarioId($dato);
        $this->assertEquals(1, $id->value());
    }

    public function test_Id_Fail_MinorZero()
    {
        $this->expectException(\Exception::class);
        $dato = -1;
        $id = new ParteDiarioId($dato);
    }
}
