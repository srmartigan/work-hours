<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RustasVistasConfigTest extends TestCase
{
    /** @test */
    public function test_de_la_vista_de_configuracion_http()
    {
        $response = $this->get('/configuracion-app');

        $response->assertStatus(200);
        $response->assertSee('Configuracion');
    }
}
