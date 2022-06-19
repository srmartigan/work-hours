<?php

declare(strict_types=1);

namespace Src\Workhours\User\Domain;

use Src\Workhours\User\Domain\ValueObjects\UserEmail;
use Src\Workhours\User\Domain\ValueObjects\UserId;
use Src\Workhours\User\Domain\ValueObjects\UserPassword;
use Src\Workhours\User\Domain\ValueObjects\UserToken;


class User
{
    private UserId $id; // UserId
    private UserEmail $email; // UserEmail
    private UserPassword $password; // UserPassword
    private UserToken $token; // UserToken

    public function __construct(UserId $id, UserEmail $email, UserPassword $password, UserToken $token)
    {
        $this->id        = $id;
        $this->email     = $email;
        $this->password  = $password;
        $this->token     = $token;
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function token(): UserToken
    {
        return $this->token;
    }

    public static function create(
        UserId $id,
        UserEmail $email,
        UserPassword $password,
        UserToken $token
    ): User
    {
        return new self($id, $email, $password, $token);
    }
}
