<?php

declare(strict_types=1);

namespace Src\Workhours\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserToken
{
    private ?string $value;

    /**
     * UserToken constructor.
     * @param string|null $token
     */
    public function __construct(string $token=null)
    {
        $this->value = $token;
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
