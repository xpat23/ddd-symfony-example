<?php

declare(strict_types=1);

namespace Product\Domain\Service\ProductAvailabilityChecking;

use Product\Domain\Entity\Client;
use Product\Domain\Entity\Product;
use Product\Domain\ValueObject\ProductAvailability;

readonly class IncreasedRateForStatesService implements ProductAvailabilityCheckingService
{
    public function __construct(
        private ProductAvailabilityCheckingService $decorated,
        private array $increaseRates
    ) {
    }

    public function checkAvailability(Product $product, Client $client): ProductAvailability
    {
        if (! array_key_exists($client->addressState(), $this->increaseRates)) {
            return $this->decorated->checkAvailability($product, $client);
        }

        $availability = $this->decorated->checkAvailability($product, $client);

        if (! $availability->isAvailable()) {
            return $availability;
        }

        return new ProductAvailability(
            $availability->isAvailable(), $availability->interestRate() + $this->increaseRates[$client->addressState()]
        );
    }
}