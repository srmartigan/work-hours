<?php

declare(strict_types=1);

namespace Tests\Unit\User\Application;

use Src\WorkHours\User\Domain\ValueObjects\UserEmail;
use Src\WorkHours\User\Domain\ValueObjects\UserPassword;
use Src\WorkHours\User\Domain\ValueObjects\UserToken;
use Tests\TestCase;
use Tests\Unit\User\Domain\Contracts\UserRepositoryContractFake;
use Src\WorkHours\User\Application\UpdateUserUseCase;
use Src\WorkHours\User\Domain\User;
use Src\WorkHours\User\Domain\ValueObjects\UserId;

class UpdateUserUseCaseTest extends TestCase
{
    public array $request = [
                'id'       => 1,
                'email'    => 'newEmail@mail.com',
                'password' => 'newPassword',
                'token'    => 'token'
    ];

    // public function testUpdateUserUseCaseSuccess()
    public function testUpdateUserUseCaseSuccess()
    {

        $useCase = UpdateUserUseCase::create(new UserRepositoryContractFake());

        $resultado = $useCase->__invoke(new Userid((int)$this->request['id']), new User(
            new UserEmail($this->request['email']),
            new UserPassword($this->request['password']),
            new UserToken($this->request['token'])
        ));
        $this->assertTrue($resultado);
    }

    // public function testUpdateUserUseCaseFail()
    public function testUpdateUserUseCaseFail()
    {
        $useCase = UpdateUserUseCase::create(new UserRepositoryContractFake());

        $resultado = $useCase->__invoke(new Userid((int)$this->request['id']+1), new User(
            new UserEmail($this->request['email']),
            new UserPassword($this->request['password']),
            new UserToken($this->request['token'])
        ));
        $this->assertFalse($resultado);
    }
}
