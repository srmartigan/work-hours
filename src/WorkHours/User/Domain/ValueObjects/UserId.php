<?php


declare(strict_types=1);

namespace Src\WorkHours\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserId
{
    private int $value;

    /**
     * UserId constructor.
     * @param int $id
     * @throws InvalidArgumentException
     */
    public function __construct(int $id)
    {
        $this->validate($id);
        $this->value = $id;
    }

    /**
     * @param int $id
     * @throws InvalidArgumentException
     */
    private
    function validate(int $id): void
    {
        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            throw new InvalidArgumentException(
                sprintf('<%s> does not allow the invalid id: <%s>.', static::class, $id)
            );
        }
    }

    public
    function value(): int
    {
        return $this->value;
    }
}
