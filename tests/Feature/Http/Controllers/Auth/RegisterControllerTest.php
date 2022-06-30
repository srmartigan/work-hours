<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_success()
    {
        $data = ['json' => '{"nombre":"admin","email":"admin@admin.com","password":"1234"}'];

        $response = $this->json('POST', '/api/register', $data);

        $response->assertStatus(200);
        $response->assertJson([
            'mensaje' => 'Usuario registrado correctamente',
            'status' => 200
        ]);
    }
    public function test_register_email_do_not_exit()
    {
        $data = ['json' => '{"nombre":"admin","password":"1234"}'];

        $response = $this->json('POST', '/api/register', $data);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'error faltan parametros',
            'status' => 400
        ]);
    }
    public function test_register_password_do_not_exit()
    {
        $data = ['json' => '{"nombre":"admin","email":"admin@admin.com"}'];

        $response = $this->json('POST', '/api/register', $data);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'error faltan parametros',
            'status' => 400
        ]);
    }

    public function test_register_name_do_not_exit()
    {
        $data = ['json' => '{"email":"admin@admin.com","password":"1234"}'];

        $response = $this->json('POST', '/api/register', $data);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'error faltan parametros',
            'status' => 400
        ]);
    }

    public function test_register_email_not_correct()
    {
        $data = ['json' => '{"nombre":"admin","email":"fake","password":"1234"}'];

        $response = $this->json('POST', '/api/register', $data);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'Fallo al validar argumentos',
            'status' => 400
        ]);
    }
    public function test_register_password_not_correct_minor_4()
    {
        $data = ['json' => '{"nombre":"admin","email":"admin@admin.com","password":"123"}'];

        $response = $this->json('POST', '/api/register', $data);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'Fallo al validar argumentos',
            'status' => 400
        ]);
    }

    public function test_register_password_not_correct_bigger_12()
    {
        $data = ['json' => '{"nombre":"admin","email":"admin@admin.com","password":"1234567891012"}'];

        $response = $this->json('POST', '/api/register', $data);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'Fallo al validar argumentos',
            'status' => 400
        ]);
    }

    //test de registro de usuario con nombre repetido

    public function test_register_name_repetido()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => hash('sha256', '1234')
        ]);

        $data = ['json' => '{"nombre":"admin","email":"admin@admin.com","password":"1234"}'];

        $response = $this->json('POST', '/api/register', $data);

        $response->assertStatus(400);
        $response->assertJson([
            'error' => 'Fallo al validar argumentos',
            'status' => 400
        ]);
    }
}
