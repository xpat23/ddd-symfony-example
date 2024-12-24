<?php

declare(strict_types=1);

namespace Client\Domain\ValueObject;

readonly class Address
{
    public function __construct(
        private string $address,
        private string $city,
        private string $state,
        private string $zip
    ) {
    }

    public function address(): string
    {
        return $this->address;
    }

    public function city(): string
    {
        return $this->city;
    }

    public function state(): string
    {
        return $this->state;
    }

    public function zip(): string
    {
        return $this->zip;
    }

}