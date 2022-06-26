<?php

namespace Tests\Feature\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example(): void
    {
        DB::table('Users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => hash('sha256', '1234')
        ]);

        $data = ['json' => '{"email":"admin@admin.com","password":"1234"}'];

        $response = $this->json('POST', '/api/login', $data);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token',
            'id',
            'status'
        ]);
    }
}
