<?php

declare(strict_types=1);

namespace Client\Application\Dto;

readonly class AddressDto
{
    public function __construct(
        public string $address,
        public string $city,
        public string $state,
        public string $zip
    ) {
    }

}