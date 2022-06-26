<?php

declare(strict_types=1);

namespace Src\WorkHours\User\Application;

use Src\WorkHours\User\Domain\Contracts\UserRepositoryContract;
use Src\WorkHours\User\Domain\User;
use Src\WorkHours\User\Domain\ValueObjects\UserEmail;
use Src\WorkHours\User\Domain\ValueObjects\UserPassword;
use Src\WorkHours\User\Domain\ValueObjects\UserToken;


final class CreateUserUseCase
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

    public function __invoke(
        string  $userEmail,
        string  $userPassword,
        ?string $userToken
    ): void
    {
        $email             = new UserEmail($userEmail);
        $password          = new UserPassword($userPassword);
        $userToken         = new UserToken($userToken);

        $user = User::create($email, $password, $userToken);

        $this->repository->save($user);
    }
}
