<?php

namespace Src\WorkHours\User\Application;

use Src\WorkHours\User\Domain\Contracts\UserRepositoryContract;
use Src\Workhours\User\Domain\ValueObjects\UserId;

class FindUserByIdUseCase
{
    private UserRepositoryContract $repository;

    public function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $userId): void
    {
        $id = new UserId($userId);
        $this->repository->findById($id);
    }
}

