<?php

declare(strict_types=1);

namespace Client\Domain\Entity;

use Client\Domain\ValueObject\Address;
use Client\Domain\ValueObject\Contact;
use Client\Domain\ValueObject\Fico;
use Client\Domain\ValueObject\Ssn;

class Client
{
    private ?int $id = null;

    public function __construct(
        private string $firstName,
        private string $lastName,
        private int $age,
        private Ssn $ssn,
        private Address $address,
        private Fico $rating,
        private float $monthlyIncome,
        private Contact $contact
    ) {
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function age(): int
    {
        return $this->age;
    }

    public function ssn(): Ssn
    {
        return $this->ssn;
    }

    public function address(): Address
    {
        return $this->address;
    }

    public function rating(): Fico
    {
        return $this->rating;
    }

    public function contact(): Contact
    {
        return $this->contact;
    }

    public function monthlyIncome(): float
    {
        return $this->monthlyIncome;
    }

    public function update(
        string $firstName,
        string $lastName,
        int $age,
        Ssn $ssn,
        Address $address,
        Fico $rating,
        float $monthlyIncome,
        Contact $contact
    ): void {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->ssn = $ssn;
        $this->address = $address;
        $this->rating = $rating;
        $this->monthlyIncome = $monthlyIncome;
        $this->contact = $contact;
    }
}