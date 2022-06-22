<?php

namespace Src\WorkHours\User\Application;

use Src\WorkHours\User\Domain\Contracts\UserRepositoryContract;
use Src\Workhours\User\Domain\User;
use Src\Workhours\User\Domain\ValueObjects\UserId;

final class FindUserByIdUseCase
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $userId): ?User
    {
        return $this->repository->findById(new UserId($userId));

    }
}

