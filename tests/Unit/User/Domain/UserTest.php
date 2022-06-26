<?php

namespace Tests\Unit\User\Domain;


use Src\WorkHours\User\Domain\User;
use Src\WorkHours\User\Domain\ValueObjects\UserEmail;
use Src\WorkHours\User\Domain\ValueObjects\UserPassword;
use Src\WorkHours\User\Domain\ValueObjects\UserToken;
use Tests\TestCase;

class UserTest extends TestCase
{

    private User $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = new User(
            new UserEmail('user@mail.com'),
            new UserPassword('password'),
            new UserToken('token')
        );
    }

    public function testUserEmail()
    {
        $this->assertEquals('user@mail.com', $this->user->email()->value());
    }

    public function testUserEmailWithInvalidEmail()
    {
        $this->assertNotEquals('fake@mail.com', $this->user->email()->value());
    }

    public function testUserPassword()
    {
        $this->assertEquals('password', $this->user->password()->value());
    }

    public function testUserPasswordWithInvalidPassword()
    {
        $this->assertNotEquals('fake', $this->user->password()->value());
    }

    public function testUserToken()
    {
        $this->assertEquals('token', $this->user->token()->value());
    }

    public function testUserTokenWithInvalidToken()
    {
        $this->assertNotEquals('fake', $this->user->token()->value());
    }

    // test create user token null  (not allowed)
    public function testUserTokenWithNull()
    {
        $this->user = new User(
            new UserEmail('user@mail.com'),
            new UserPassword('password')
        );

        $this->assertNull($this->user->token()->value());
        $this->assertEquals('user@mail.com', $this->user->email()->value());
        $this->assertEquals('password', $this->user->password()->value());

    }

}
