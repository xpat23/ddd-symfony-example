<?php

declare(strict_types=1);

namespace Product\Domain\Service\ProductAvailabilityChecking;

use Product\Domain\Entity\Client;
use Product\Domain\Entity\Product;
use Product\Domain\ValueObject\ProductAvailability;

readonly class MonthlyIncomeBasedCheckingService implements ProductAvailabilityCheckingService
{
    public function __construct(
        private ProductAvailabilityCheckingService $decorated,
        private float $minimumMonthlyIncome
    ) {
    }

    public function checkAvailability(Product $product, Client $client): ProductAvailability
    {
        $monthlyIncome = $client->monthlyIncome();

        if ($monthlyIncome < $this->minimumMonthlyIncome) {
            return new ProductAvailability(false, 0);
        }

        return $this->decorated->checkAvailability($product, $client);
    }
}