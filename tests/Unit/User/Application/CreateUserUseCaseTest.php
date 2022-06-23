<?php

namespace Tests\Unit\User\Application;

use Tests\TestCase;
use Src\WorkHours\User\Application\CreateUserUseCase;
use Tests\Unit\User\Domain\Contracts\UserRepositoryContractFake;
use Tests\Unit\User\Domain\Exception\ExceptionSuccess;


class CreateUserUseCaseTest extends TestCase
{
//test create user token null  (not allowed)
    public function testUserTokenWithNull()
    {
        $this->expectException(\InvalidArgumentException::class);

        $createUser = CreateUserUseCase::create(new UserRepositoryContractFake());
        $createUser(
            'fake',
            'password',
            'token'
        );
    }

    public function testCreateUserWithInvalidPassword()
    {
        $this->expectException(\InvalidArgumentException::class);

        $createUser = CreateUserUseCase::create(new UserRepositoryContractFake());
        $createUser(
            'user@mail.com',
            'fake',
            'token'
        );
    }

    // test crate user not exceptions   (success)
    public function testCreateUserSuccess()
    {
        $createUser = CreateUserUseCase::create(new UserRepositoryContractFake());
        $createUser(
            'user@mail.com',
            'password',
            'token'
        );

        $this->assertTrue(true);
    }

}
