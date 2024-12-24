<?php

declare(strict_types=1);

namespace Product\Domain\Service\ProductAvailabilityChecking;

use Product\Domain\Entity\Client;
use Product\Domain\Entity\Product;
use Product\Domain\ValueObject\ProductAvailability;

readonly class StateBasedCheckingService implements ProductAvailabilityCheckingService
{
    public function __construct(
        private ProductAvailabilityCheckingService $decorated,
        private array $allowedStates
    ) {
    }

    public function checkAvailability(Product $product, Client $client): ProductAvailability
    {
        if (! in_array($client->addressState(), $this->allowedStates, true)) {
            return new ProductAvailability(false, 0);
        }

        return $this->decorated->checkAvailability($product, $client);
    }
}