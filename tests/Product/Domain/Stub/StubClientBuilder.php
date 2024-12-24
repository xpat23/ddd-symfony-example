<?php

declare(strict_types=1);

namespace Tests\Product\Domain\Stub;

use Product\Domain\Entity\Client;

final class StubClientBuilder
{
    private int $id = 1;
    private int $rating = 500;
    private float $monthlyIncome = 1000.0;
    private int $age = 30;
    private string $addressState = 'NY';

    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    public function build(): Client
    {
        return new Client(
            $this->id,
            $this->rating,
            $this->monthlyIncome,
            $this->age,
            $this->addressState
        );
    }

    public function withId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }

    public function withMonthlyIncome(float $monthlyIncome): self
    {
        $this->monthlyIncome = $monthlyIncome;

        return $this;
    }

    public function withAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function withAddressState(string $addressState): self
    {
        $this->addressState = $addressState;

        return $this;
    }
}