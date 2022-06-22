<?php

namespace Tests\Unit\User\Application;

use Tests\TestCase;
use Src\WorkHours\User\Application\CreateUserUseCase;
use Tests\Unit\User\Domain\Contracts\UserRepositoryContractFake;


class CreateUserUseCaseTest extends TestCase
{
//test create user token null  (not allowed)
    public function testUserTokenWithNull()
    {
        $this->expectException(\InvalidArgumentException::class);

        $createUser = new CreateUserUseCase(new UserRepositoryContractFake());
        $createUser->__invoke(
            'fake',
            'password',
            null
        );
    }

    public function testCreateUserWithInvalidPassword()
    {
        $this->expectException(\InvalidArgumentException::class);

        $createUser = new CreateUserUseCase(new UserRepositoryContractFake());
        $createUser->__invoke(
            'user@mail.com',
            'fake',
            'token'
        );
    }
}
