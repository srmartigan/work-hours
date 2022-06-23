<?php

namespace Src\WorkHours\User\Domain\Exceptions;

class valueIsNotCorrect extends \InvalidArgumentException
{
    public static function create(string $value): valueIsNotCorrect
    {
        return new self("Value {$value} is not correct");
    }
}
