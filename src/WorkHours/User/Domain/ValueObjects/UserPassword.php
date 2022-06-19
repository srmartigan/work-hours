<?php


declare(strict_types=1);

namespace Src\Workhours\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserPassword
{
    private string $value;

    /**
     * UserPassword constructor.
     * @param string $password
     * @throws InvalidArgumentException
     */
    public function __construct(string $password)
    {
        $this->value = $password;
    }

    public function value(): string
    {
        return $this->value;
    }
}
