<?php

namespace App\Domain\Dto;

class RegisterDto
{
    private string $nombre;
    private string $email;
    private string $password;

    private function __construct($nombre, $email, $password)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
    }

    public static function create($nombre, $email, $password): self
    {
        return new self($nombre, $email, $password);
    }

    public function nombre(): string
    {
        return $this->nombre;
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
            'nombre' => $this->nombre,
            'email' => $this->email,
            'password' => $this->password
        ];
    }

}
