<?php

declare(strict_types=1);

namespace Client\Application\Dto;

readonly class ClientDto
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
        public int $age,
        public string $ssn,
        public AddressDto $address,
        public int $rating,
        public float $monthlyIncome,
        public string $email,
        public string $phone
    ) {
    }

}