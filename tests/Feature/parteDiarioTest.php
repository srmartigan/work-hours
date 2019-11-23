<?php

namespace Tests\Feature;

use App\User;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class parteDiarioTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testVistaParteDiario()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->get('parte-diario')
            ->assertStatus(200)
            ->assertsee('PARTE DIARIO');
    }

    /** @test */
    public function testCreateParteDiario()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $this->post('incluir-parte-diario', [

            'fecha' => new DateTime(),
            'hora_de_entrada' => '06:00',
            'hora_de_salida' => '09:00',
            'almuerzo' => 1,
            'comida' => 1,
            'merienda' => 1
        ])->assertViewIs('app.inicio');

        $this->assertDatabaseHas('parte_diarios', [
            'HoraEntrada' => '06:00',
            'HoraSalida' => '09:00',
            'TotalHoras' => '03:00'
        ]);


    }
}
