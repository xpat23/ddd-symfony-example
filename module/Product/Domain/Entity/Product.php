<?php

declare(strict_types=1);

namespace Product\Domain\Entity;

readonly class Product
{
    public function __construct(
        private int $id,
        private string $name,
        private int $term,
        private float $interestRate,
        private float $amount,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function term(): int
    {
        return $this->term;
    }

    public function interestRate(): float
    {
        return $this->interestRate;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}