<?php

declare(strict_types=1);

namespace Product\Domain\Service\ProductAvailabilityChecking;

use Product\Domain\Entity\Client;
use Product\Domain\Entity\Product;
use Product\Domain\Service\RandomizerService;
use Product\Domain\ValueObject\ProductAvailability;

readonly class RandomAvailabilityForStatesService implements ProductAvailabilityCheckingService
{
    public function __construct(
        private ProductAvailabilityCheckingService $decorated,
        private RandomizerService $randomizer,
        private array $states
    ) {
    }

    public function checkAvailability(Product $product, Client $client): ProductAvailability
    {
        if (! in_array($client->addressState(), $this->states, true)) {
            return $this->decorated->checkAvailability($product, $client);
        }

        if ($this->randomizer->next()) {
            return $this->decorated->checkAvailability($product, $client);
        }

        return new ProductAvailability(false, 0);
    }
}