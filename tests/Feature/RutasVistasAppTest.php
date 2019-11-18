<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\ParteDiarioController;


class RutasVistasAppTest extends TestCase
{


    /** @test */
    public function testRutaInicio()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Estamos en el HOME');
    }

    /** @test */
    public function testRutaParteDiario()
    {
        $this->withoutMiddleware();
        $this->get('parte-diario')
            ->assertStatus(200)
            ->assertSee('PARTE DIARIO');
    }


    /** @test */
    public function testRutaDocumentos()
    {
        $this->withoutMiddleware();
        $this->get('/documentos')
            ->assertStatus(200)
            ->assertSee('Estamos en Documentos');
    }
    /** @test */
    public function testRutaCalendario()
    {
        $this->withoutMiddleware();
        $this->get('/calendario')
            ->assertStatus(200)
            ->assertSee('Calendario');
    }

}
