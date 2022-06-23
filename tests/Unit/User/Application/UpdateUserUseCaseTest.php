<?php

namespace Tests\Unit\User\Application;

use Src\Workhours\User\Domain\ValueObjects\UserEmail;
use Src\Workhours\User\Domain\ValueObjects\UserPassword;
use Src\Workhours\User\Domain\ValueObjects\UserToken;
use Tests\TestCase;
use Tests\Unit\User\Domain\Contracts\UserRepositoryContractFake;
use Src\WorkHours\User\Application\UpdateUserUseCase;
use Src\Workhours\User\Domain\User;
use Src\Workhours\User\Domain\ValueObjects\UserId;

class UpdateUserUseCaseTest extends TestCase
{
    // public function testUpdateUserUseCaseSuccess()

    public function testUpdateUserUseCaseSuccess()
    {
        $useCase = UpdateUserUseCase::create(new UserRepositoryContractFake());
        $resultado = $useCase->__invoke(new Userid(1),new User(
            new UserEmail('user@mail.com'),
            new UserPassword('password'),
            new UserToken('token1')
        ));
        $this->assertTrue($resultado);
    }

    // public function testUpdateUserUseCaseFail()
    public function testUpdateUserUseCaseFail()
    {
        $useCase = UpdateUserUseCase::create(new UserRepositoryContractFake());
        $resultado = $useCase->__invoke(new Userid(2),new User(
            new UserEmail('user@mail.com'),
            new UserPassword('password'),
            new UserToken('token1')
        ));
        $this->assertFalse($resultado);
   }
}
