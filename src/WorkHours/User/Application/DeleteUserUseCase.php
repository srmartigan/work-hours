<?php

declare(strict_types=1);

namespace Src\WorkHours\User\Application;

use Src\WorkHours\User\Domain\Contracts\UserRepositoryContract;
use Src\Workhours\User\Domain\ValueObjects\UserId;

final class DeleteUserUseCase
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

    public function __invoke(int $userId): void
    {
        $id = new UserId($userId);
        $this->repository->delete($id);
    }
}
