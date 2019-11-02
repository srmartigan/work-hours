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
        $this->get('parte-diario')
            ->assertStatus(200)
            ->assertSee('PARTE DIARIO');
    }

    /** @test */
    public function testRutaEnviarParteDiario()
    {
        $this->post( '/incluir-parte-diario' )
            ->assertStatus(200);
    }
    /** @test */
    public function testRutaDocumentos()
    {
        $this->get('/documentos')
            ->assertStatus(200)
            ->assertSee('Estamos en Documentos');
    }
    /** @test */
    public function testRutaCalendario()
    {
        $this->get('/calendario')
            ->assertStatus(200)
            ->assertSee('Calendario');
    }

}
