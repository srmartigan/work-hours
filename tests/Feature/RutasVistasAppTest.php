<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\ParteDiarioController;


class RutasVistasAppTest extends TestCase
{
    use RefreshDatabase;
    public function create_and_login_user()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
    }
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
        $this->create_and_login_user();
        $this->get('parte-diario')
            ->assertStatus(200)
            ->assertSee('PARTE DIARIO');
    }


    /** @test */
    public function testRutaDocumentos()
    {
        $this->create_and_login_user();
        $this->get('/documentos')
            ->assertStatus(200)
            ->assertSee('Estamos en Documentos');
    }
    /** @test */
    public function testRutaListadoPartes()
    {
        $this->create_and_login_user();
        $this->get('/listado-partes')
            ->assertStatus(200)
            ->assertSee('Listado Partes');
    }

}
