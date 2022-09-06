<?php

namespace App\Domain\Dto;

class TokenDto
{
    private int $id;
    private string $token;

    public function __construct(int $id, string $token)
    {
        $this->id = $id;
        $this->token = $token;
    }

    public function valueToken():string
    {
        return $this->token;
    }

    public function valueId():int
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->token;
    }
}
