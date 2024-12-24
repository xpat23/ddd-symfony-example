<?php

declare(strict_types=1);

namespace Client\Domain\ValueObject;

use InvalidArgumentException;

readonly class Fico
{

    public function __construct(private int $value)
    {
        if ($value < 300 || $value > 850) {
            throw new InvalidArgumentException('Invalid FICO score');
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}