<?php

declare(strict_types=1);

namespace Product\Domain\Event;

readonly class ProductIssuedEvent
{
    public function __construct(
        private int $productId,
        private int $clientId,
    ) {
    }

    public function productId(): int
    {
        return $this->productId;
    }

    public function clientId(): int
    {
        return $this->clientId;
    }
}