<?php

declare(strict_types=1);

namespace Product\Application\Dto;

readonly class ProductAvailabilityDto
{
    public function __construct(
        public bool $isAvailable,
        public float $interestRate
    ) {
    }
}