<?php

declare(strict_types=1);

namespace Product\Domain\Service\ProductAvailabilityChecking;

use Product\Domain\Entity\Client;
use Product\Domain\Entity\Product;
use Product\Domain\ValueObject\ProductAvailability;

readonly class AgeBasedCheckingService implements ProductAvailabilityCheckingService
{
    public function __construct(
        private ProductAvailabilityCheckingService $decorated,
        private int $minimumAge,
        private int $maximumAge
    ) {
    }

    public function checkAvailability(Product $product, Client $client): ProductAvailability
    {
        $age = $client->age();

        if ($age < $this->minimumAge || $age > $this->maximumAge) {
            return new ProductAvailability(false, 0);
        }

        return $this->decorated->checkAvailability($product, $client);
    }
}