<?php

declare(strict_types=1);

namespace Product\Infrastructure\Repository;

use Client\Application\Service\GetClientByIdService;
use Product\Domain\Entity\Client;
use Product\Domain\Repository\ClientRepository;

readonly class ProxyClientRepository implements ClientRepository
{

    public function __construct(private GetClientByIdService $clients)
    {
    }

    public function findById(int $id): ?Client
    {
        $clientDto = $this->clients->execute($id);

        if ($clientDto === null) {
            return null;
        }

        return new Client(
            $clientDto->id,
            $clientDto->rating,
            $clientDto->monthlyIncome,
            $clientDto->age,
            $clientDto->address->state,
        );
    }
}