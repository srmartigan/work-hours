<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class userTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateNewUser()
    {
        $response = $this->post(route('register'), [
            'name' => 'JMac',
            'email' => 'jmac@example.com',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ]);
        $response->assertRedirect('/');

        $this->assertDatabaseHas('users', [
            'name' => 'JMac',
            'email' => 'jmac@example.com'
        ]);
    }

    public function testLoginUser()
    {
        $this->post('login' , [
           'email' => 'lolo@admin.com',
           'password' => '1234'
        ])->assertRedirect('/');
    }
}
