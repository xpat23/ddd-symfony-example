<?php

declare(strict_types=1);

namespace Client\Application\Service;

use Client\Application\Dto\AddressDto;
use Client\Application\Dto\ClientDto;
use Client\Domain\Repository\ClientRepository;

readonly class GetClientByIdService
{

    public function __construct(
        private ClientRepository $clients
    ) {
    }

    public function execute(int $id): ?ClientDto
    {
        $client = $this->clients->findById($id);

        if ($client === null) {
            return null;
        }

        return new ClientDto(
            $client->id(),
            $client->firstName(),
            $client->lastName(),
            $client->age(),
            $client->ssn()->value(),
            new AddressDto(
                $client->address()->address(),
                $client->address()->city(),
                $client->address()->state(),
                $client->address()->zip()
            ),
            $client->rating()->value(),
            $client->monthlyIncome(),
            $client->contact()->email(),
            $client->contact()->phone()
        );
    }

}