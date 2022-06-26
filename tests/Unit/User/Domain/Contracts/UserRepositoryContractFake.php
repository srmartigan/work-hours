<?php

namespace Tests\Unit\User\Domain\Contracts;

use phpDocumentor\Reflection\Types\Boolean;
use Src\WorkHours\User\Domain\Contracts\UserRepositoryContract;
use Src\WorkHours\User\Domain\Exceptions\valueIsNotCorrect;
use Src\WorkHours\User\Domain\User;
use Src\WorkHours\User\Domain\ValueObjects\UserEmail;
use Src\WorkHours\User\Domain\ValueObjects\UserId;
use Src\WorkHours\User\Domain\ValueObjects\UserPassword;
use Src\WorkHours\User\Domain\ValueObjects\UserToken;
use Tests\Unit\User\Domain\Exception\ExceptionSuccess;

class UserRepositoryContractFake implements UserRepositoryContract
{
    public function save(User $user): void
    {
        if ($user->email()->value() == 'fake') {
            throw new \InvalidArgumentException('User email cannot be fake');
        }
        if ($user->password()->value() == 'fake') {
            throw new \InvalidArgumentException('User password cannot be fake');
        }
   }

    public function findById(UserId $id): ?User
    {
        if ($id->value() == 1) {
            return new User(
                new UserEmail('user@mail.com'),
                new UserPassword('password'),
                new UserToken('token'),
            );
        }
        throw new \InvalidArgumentException('User not found');
    }


    public function findByCriteria(UserEmail $userEmail): ?User
    {
        return null;
    }

    public function update(UserId $userId, User $user): bool
    {
        if ($userId->value() == 1 ) {
            return true;
        }
        return false;
    }

    public function delete(UserId $id): void
    {
        if ($id->value() != 1) {
            throw valueIsNotCorrect::create($id->value());
        }
        if ($id->value() == 1) {
            throw new ExceptionSuccess('User successfully deleted');
        }
    }
}
