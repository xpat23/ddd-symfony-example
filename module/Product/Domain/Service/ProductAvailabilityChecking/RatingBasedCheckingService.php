<?php

declare(strict_types=1);

namespace Product\Domain\Service\ProductAvailabilityChecking;

use Product\Domain\Entity\Client;
use Product\Domain\Entity\Product;
use Product\Domain\ValueObject\ProductAvailability;

readonly class RatingBasedCheckingService implements ProductAvailabilityCheckingService
{
    public function __construct(
        private int $minimumRating
    ) {
    }

    public function checkAvailability(Product $product, Client $client): ProductAvailability
    {
        $interestRate = $product->interestRate();
        $rating = $client->rating();

        if ($rating < $this->minimumRating) {
            return new ProductAvailability(false, 0);
        }

        return new ProductAvailability(true, $interestRate);
    }
}