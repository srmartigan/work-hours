<?php

namespace Tests\Feature;

use Tests\TestCase;

class RutasAuthTest extends TestCase
{
    /** @test */
    public function test_route_login_auth()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    /** @test */
    public function test_route_register_auth()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertSee('Register');
    }
}
