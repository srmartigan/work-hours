<?php

declare(strict_types=1);

namespace App\Domain\Dto;

class LoginDto
{
    private string $email;
    private string $password;

    private function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public static function create($email, $password): self
    {
        return new self($email, $password);
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password
        ];
    }

}
