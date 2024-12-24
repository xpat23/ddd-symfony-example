<?php

declare(strict_types=1);

namespace Product\Infrastructure\Repository;

use Product\Domain\Entity\Product;
use Product\Domain\Repository\ProductRepository;

readonly class StubProductRepository implements ProductRepository
{

    public function findById(int $id): ?Product
    {
        $products = [
            1 => new Product(1, 'Product 1', 14, 10, 100.0),
            2 => new Product(2, 'Product 2', 14, 8, 200.0),
            3 => new Product(3, 'Product 3', 14, 12, 300.0),
        ];

        return $products[$id] ?? null;
    }
}