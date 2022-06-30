<?php

declare(strict_types=1);

namespace Src\WorkHours\User\Domain\Contracts;

use Src\WorkHours\User\Domain\User;
use Src\WorkHours\User\Domain\ValueObjects\UserEmail;
use Src\WorkHours\User\Domain\ValueObjects\UserId;

interface UserRepositoryContract
{
    public function findByCriteria(UserEmail $userEmail): ?User;

    public function findById(UserId $id): ?User;

    public function save(User $user): void;

    public function update(UserId $userId, User $user): bool;

    public function delete(UserId $id): void;
}
