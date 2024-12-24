<?php

declare(strict_types=1);

namespace Product\Domain\Repository;

use Product\Domain\Entity\Client;

interface ClientRepository
{
    public function findById(int $id): ?Client;
}