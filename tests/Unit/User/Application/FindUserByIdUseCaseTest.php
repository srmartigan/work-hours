<?php

namespace Tests\Unit\User\Application;

use Src\WorkHours\User\Application\FindUserByIdUseCase;
use Src\Workhours\User\Domain\User;
use Tests\TestCase;
use Tests\Unit\User\Domain\Contracts\UserRepositoryContractFake;

class FindUserByIdUseCaseTest extends TestCase
{

    public function testFindUserByIdUseCaseSuccess()
    {
        $useCase = FindUserByIdUseCase::create(new UserRepositoryContractFake());
        $user = $useCase(1);
        $this->assertInstanceOf(User::class, $user);
    }

    public function testFindUserByIdUseCaseFail()
    {
        $useCase = FindUserByIdUseCase::create(new UserRepositoryContractFake());
        $this->expectException(\InvalidArgumentException::class);
        $user = $useCase->__invoke(2);
    }

}
