<?php

declare(strict_types=1);

namespace Product\Application\Dto;

readonly class IssueProductToClientDto
{
    public function __construct(
        public int $productId,
        public int $clientId,
    ) {
    }
}