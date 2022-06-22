<?php

declare(strict_types=1);

namespace Src\Workhours\User\Domain;

use Src\Workhours\User\Domain\ValueObjects\UserEmail;
use Src\Workhours\User\Domain\ValueObjects\UserPassword;
use Src\Workhours\User\Domain\ValueObjects\UserToken;


class User
{
    private UserEmail $email; // UserEmail
    private UserPassword $password; // UserPassword
    private UserToken $token; // UserToken

    public function __construct(UserEmail $email, UserPassword $password, UserToken $token=null)
    {
        $this->email     = $email;
        $this->password  = $password;
        $this->token     = $token ?? new UserToken(null);

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
        if(is_null($this->token)){
            return null;
        }
        return $this->token;
    }

    public static function create(
        UserEmail $email,
        UserPassword $password,
        ?UserToken $token
    ): User
    {
        return new self($email, $password, $token);
    }
}
