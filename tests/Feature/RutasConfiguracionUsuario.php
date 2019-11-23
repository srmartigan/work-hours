<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RutasConfiguracionUsuario extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function testVistaConfiguracionUsuario()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->get('configuracion-usuario')
            ->assertStatus(200)
            ->assertViewIs('app.configuracionUsuario');


        $this->assertDatabaseHas('configuracion_usuarios' , [
           'descuento_almuerzo' => 0
        ]);


    }
}
