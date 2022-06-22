<?php

namespace Tests\Unit\User\Application;

use Tests\Unit\User\Domain\Exception\ExceptionSuccess;
use Src\WorkHours\User\Application\DeleteUserUseCase;
use Tests\TestCase;
use Tests\Unit\User\Domain\Contracts\UserRepositoryContractFake;


class DeleteUserUseCaseTest extends TestCase
{
    public function testDeleteUserFail()
    {
        $this->expectException(\InvalidArgumentException::class);

        $deleteUser = new DeleteUserUseCase(new UserRepositoryContractFake());
        $deleteUser->__invoke(0);
    }

    public function testDeleteUserSuccess()
    {
        $this->expectException(ExceptionSuccess::class);

        $deleteUser = new DeleteUserUseCase(new UserRepositoryContractFake());
        $deleteUser->__invoke(1);
    }
}
