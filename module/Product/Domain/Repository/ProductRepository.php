<?php

declare(strict_types=1);

namespace Product\Domain\Repository;

use Product\Domain\Entity\Product;

interface ProductRepository
{
    public function findById(int $id): ?Product;
}