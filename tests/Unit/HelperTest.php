<?php


namespace Tests\Unit;


use Tests\TestCase;
use App\Helper;

class HelperTest extends TestCase
{

    /** @test */
    public function testMetodoCalcularTotalHoras()
    {
        $horaEntrada = '06:00';
        $horaSalida = '14:00';
        $totalHoras = Helper::calcularTotalHoras($horaEntrada,$horaSalida);
        $this->assertSame('08:00', $totalHoras);
    }

    /** @test */
    public function testMetodoDateFomartSpanish()
    {

        $fakeLengthAwarePaginator = new FakeLengthAwarePaginator();
        $fakeLengthAwarePaginator->fecha = '1978-08-30';
        $lap = [ 'item' => $fakeLengthAwarePaginator];

        Helper::dateFormatSpanish($lap);

        $this->assertSame('30-08-1978' , $fakeLengthAwarePaginator->fecha);
    }

    /** @test */
    public function testConvertDateArray()
    {
        $fecha = '1978-08-30';
        $arrayFecha = Helper::convertDateArray($fecha);
        $this->assertSame(30 , $arrayFecha['dia']);
        $this->assertSame(8 , $arrayFecha['mes']);
        $this->assertSame(1978 , $arrayFecha['year']);

    }

    /** @test */
    public function testGetMesActual()
    {
        $date = new \DateTime();
        $mes = $date->format('m');
        $this->assertSame($mes, Helper::getMesActual());
    }
}

class FakeLengthAwarePaginator
{
    public $fecha;

    public function __construct()
    {
        $this->fecha = null;
    }

}
