<?php

declare(strict_types=1);

namespace Product\Domain\Service\ProductAvailabilityChecking;

use Product\Domain\Entity\Client;
use Product\Domain\Entity\Product;
use Product\Domain\ValueObject\ProductAvailability;

interface ProductAvailabilityCheckingService
{
    public function checkAvailability(Product $product, Client $client): ProductAvailability;
}