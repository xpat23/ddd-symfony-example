<?php

declare(strict_types=1);

namespace Product\Domain\ValueObject;

readonly class ProductAvailability
{
    public function __construct(
        private bool $isAvailable,
        private float $interestRate,
    ) {
    }

    public function isAvailable(): bool
    {
        return $this->isAvailable;
    }

    public function interestRate(): float
    {
        return $this->interestRate;
    }
}