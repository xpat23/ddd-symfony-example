<?php

declare(strict_types=1);

namespace Client\Application\Service;

use Client\Application\Dto\UpdateClientDto;
use Client\Application\Exception\ClientNotFound;
use Client\Domain\Repository\ClientRepository;
use Client\Domain\ValueObject\Address;
use Client\Domain\ValueObject\Contact;
use Client\Domain\ValueObject\Fico;
use Client\Domain\ValueObject\Ssn;

readonly class UpdateClientService
{
    public function __construct(private ClientRepository $clients)
    {
    }

    /**
     * @throws ClientNotFound
     */
    public function execute(int $id, UpdateClientDto $dto): void
    {
        $client = $this->clients->findById($id);

        if ($client === null) {
            throw ClientNotFound::byId($id);
        }

        $client->update(
            $dto->firstName,
            $dto->lastName,
            $dto->age,
            new Ssn($dto->ssn),
            new Address(
                $dto->address->address,
                $dto->address->city,
                $dto->address->state,
                $dto->address->zip
            ),
            new Fico($dto->rating),
            $dto->monthlyIncome,
            new Contact($dto->email, $dto->phone)
        );

        $this->clients->update($client);
    }
}