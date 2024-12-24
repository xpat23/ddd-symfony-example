<?php

declare(strict_types=1);

namespace Product\Domain\Entity;

readonly class Client
{
    public function __construct(
        private int $id,
        private int $rating,
        private float $monthlyIncome,
        private int $age,
        private string $addressState
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function rating(): int
    {
        return $this->rating;
    }

    public function monthlyIncome(): float
    {
        return $this->monthlyIncome;
    }

    public function age(): int
    {
        return $this->age;
    }

    public function addressState(): string
    {
        return $this->addressState;
    }
}