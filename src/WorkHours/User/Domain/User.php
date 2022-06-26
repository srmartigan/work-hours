<?php

declare(strict_types=1);

namespace Src\WorkHours\User\Domain;

use Src\WorkHours\User\Domain\ValueObjects\UserEmail;
use Src\WorkHours\User\Domain\ValueObjects\UserId;
use Src\WorkHours\User\Domain\ValueObjects\UserPassword;
use Src\WorkHours\User\Domain\ValueObjects\UserToken;


class User
{
    private UserId $id;
    private UserEmail $email; // UserEmail
    private UserPassword $password; // UserPassword
    private UserToken $token; // UserToken

    public function __construct(UserEmail $email, UserPassword $password, UserToken $token=null)
    {
        $this->email     = $email;
        $this->password  = $password;
        $this->token     = $token ?? new UserToken(null);

    }

    public static function create(UserEmail $email,UserPassword $password,?UserToken $token): self
    {
        return new self($email, $password, $token);
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function token(): ?UserToken
    {
        return $this->token;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function setId(UserId $id): void
    {
        $this->id = $id;
    }
}
