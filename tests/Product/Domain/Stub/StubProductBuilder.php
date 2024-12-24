<?php

declare(strict_types=1);

namespace Tests\Product\Domain\Stub;

use Product\Domain\Entity\Product;

final class StubProductBuilder
{
    private int $id = 1;
    private string $name = 'Product';
    private int $term = 14;
    private float $interestRate = 5.5;
    private float $amount = 1000.0;

    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    public function build(): Product
    {
        return new Product(
            $this->id,
            $this->name,
            $this->term,
            $this->interestRate,
            $this->amount
        );
    }

    public function withId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function withTerm(int $term): self
    {
        $this->term = $term;

        return $this;
    }

    public function withInterestRate(float $interestRate): self
    {
        $this->interestRate = $interestRate;

        return $this;
    }

    public function withAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

}