<?php

namespace Src\WorkHours\User\Application;

use Src\WorkHours\User\Domain\Contracts\UserRepositoryContract;
use Src\WorkHours\User\Domain\User;
use Src\WorkHours\User\Domain\ValueObjects\UserId;


final class FindUserByIdUseCase
{
    private UserRepositoryContract $repository;

    private function __construct(UserRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public static function create(UserRepositoryContract $repository): self
    {
        return new self($repository);
    }

    public function __invoke(int $userId): ?User
    {
        return $this->repository->findById(new UserId($userId));

    }
}

