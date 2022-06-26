<?php

namespace Src\WorkHours\User\Application;

use phpDocumentor\Reflection\Types\Self_;
use Src\WorkHours\User\Domain\Contracts\UserRepositoryContract;
use Src\WorkHours\User\Domain\User;
use Src\WorkHours\User\Domain\ValueObjects\UserId;


final class UpdateUserUseCase
{
    private UserRepositoryContract $userRepository;

    private function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public static function create(UserRepositoryContract $repository): self
    {
        return new self($repository);
    }

    public function __invoke(UserId $userId, User $user): bool
    {
        return $this->userRepository->update($userId, $user);
    }
}
