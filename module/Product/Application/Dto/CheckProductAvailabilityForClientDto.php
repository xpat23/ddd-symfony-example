<?php

declare(strict_types=1);

namespace Product\Application\Dto;

readonly class CheckProductAvailabilityForClientDto
{
    public function __construct(
        public int $productId,
        public int $clientId
    ) {
    }
}