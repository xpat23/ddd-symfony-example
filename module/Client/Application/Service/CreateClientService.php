<?php

declare(strict_types=1);

namespace Client\Application\Service;

use Client\Application\Dto\CreateClientDto;
use Client\Domain\Entity\Client;
use Client\Domain\Repository\ClientRepository;
use Client\Domain\ValueObject\Address;
use Client\Domain\ValueObject\Contact;
use Client\Domain\ValueObject\Fico;
use Client\Domain\ValueObject\Ssn;

readonly class CreateClientService
{
    public function __construct(private ClientRepository $clients)
    {
    }

    public function execute(CreateClientDto $dto): void
    {
        $client = new Client(
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

        $this->clients->add($client);
    }
}