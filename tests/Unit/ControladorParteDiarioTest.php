<?php


namespace Tests\Unit;


use Illuminate\Http\Request;
use Tests\TestCase;
use App\Http\Controllers\ParteDiarioController;

class ControladorParteDiarioTest extends TestCase
{

    /** @test */
    public function testMetodoIndexRetornaUnaVista()
    {
        $parteDiarioController = $this->IniciarControlador();
        $this->assertIsObject($parteDiarioController->index());
    }



    protected function IniciarControlador(): ParteDiarioController
    {
        $parteDiarioController = new ParteDiarioController();
        return $parteDiarioController;
    }
}
