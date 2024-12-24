<?php

declare(strict_types=1);

namespace Client\Domain\Repository;

use Client\Domain\Entity\Client;

interface ClientRepository
{
    public function add(Client $client): void;

    public function update(Client $client): void;

    public function findById(int $id): ?Client;
}