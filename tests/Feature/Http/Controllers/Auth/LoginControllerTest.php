<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function insertUserDB(): void
    {
        DB::table('Users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => hash('sha256', '1234')
        ]);
    }

    public function test_login_success(): void
    {
        $this->insertUserDB();

        $data = ['json' => '{"email":"admin@admin.com","password":"1234"}'];

        $response = $this->json('POST', '/api/login', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token',
            'id',
            'status'
        ]);
    }


    function test_login_password_do_not_exit(): void
    {
        $this->insertUserDB();

        $data = ['json' => '{"email":"admin@admin.com","password":"fake"}'];

        $response = $this->json('POST', '/api/login', $data);
        $response->assertStatus(401);
    }

    public function test_login_email_do_not_exit(): void
    {
        $this->insertUserDB();

        $data = ['json' => '{"email":"fake@admin.com","password":"1234"}'];

        $response = $this->json('POST', '/api/login', $data);
        $response->assertStatus(401);


    }

    public function test_login_email_and_password_do_not_exit(): void
    {
        $this->insertUserDB();

        $data = ['json' => '{"email":"fake@admin.com","password":"fake"}'];

        $response = $this->json('POST', '/api/login', $data);

        $response->assertStatus(401);

    }

    public function test_login_argument_email_do_not_exit(): void
    {
        $this->insertUserDB();

        $data = ['json' => '{"password":"1234"}'];

        $response = $this->json('POST', '/api/login', $data);

        $response->assertStatus(400);
    }

    public function test_login_argument_password_do_not_exit(): void
    {
        $this->insertUserDB();

        $data = ['json' => '{"email":"admin@admin.com"}'];

        $response = $this->json('POST', '/api/login', $data);

        $response->assertStatus(400);
    }
}
