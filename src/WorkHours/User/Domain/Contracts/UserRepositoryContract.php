<?php

declare(strict_types=1);

namespace Src\WorkHours\User\Domain\Contracts;

use Src\Workhours\User\Domain\User;
use Src\Workhours\User\Domain\ValueObjects\UserEmail;
use Src\Workhours\User\Domain\ValueObjects\UserId;

interface UserRepositoryContract
{
    public function find(UserId $id): ?User;

    public function findByCriteria(UserEmail $userEmail): ?User;

    public function save(User $user): void;

    public function update(UserId $userId, User $user): void;

    public function delete(UserId $id): void;
}
