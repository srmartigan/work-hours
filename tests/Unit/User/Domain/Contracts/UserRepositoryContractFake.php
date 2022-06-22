<?php

namespace Tests\Unit\User\Domain\Contracts;

use Src\WorkHours\User\Domain\Contracts\UserRepositoryContract;
use Src\Workhours\User\Domain\User;
use Src\Workhours\User\Domain\ValueObjects\UserEmail;
use Src\Workhours\User\Domain\ValueObjects\UserId;
use Src\Workhours\User\Domain\ValueObjects\UserPassword;
use Src\Workhours\User\Domain\ValueObjects\UserToken;
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

    public function update(UserId $userId, User $user): void
    {
    }

    public function delete(UserId $id): void
    {
        if ($id->value() != 1) {
            throw new \InvalidArgumentException('User cannot be deleted');
        }
        if ($id->value() == 1) {
            throw new ExceptionSuccess('User successfully deleted');
        }
    }
}
