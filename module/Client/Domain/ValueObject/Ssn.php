<?php

declare(strict_types=1);

namespace Client\Domain\ValueObject;

use InvalidArgumentException;

readonly class Ssn
{
    public function __construct(private string $value)
    {
        if (! preg_match('/^\d{3}-\d{2}-\d{4}$/', $value)) {
            throw new InvalidArgumentException('Invalid SSN.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}