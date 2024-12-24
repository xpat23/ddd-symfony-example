<?php

declare(strict_types=1);

namespace Product\Application\Service;

use Product\Application\Dto\CheckProductAvailabilityForClientDto;
use Product\Application\Dto\IssueProductToClientDto;
use Product\Application\Exception\ProductIsNotAvailable;
use Product\Domain\Event\EventBus;
use Product\Domain\Event\ProductIssuedEvent;

readonly class IssueProductToClientService
{
    public function __construct(
        private CheckProductAvailabilityForClientService $availabilityService,
        private EventBus $eventBus,
    ) {
    }

    public function execute(IssueProductToClientDto $dto): void
    {
        $availability = $this->availabilityService->execute(
            new CheckProductAvailabilityForClientDto(
                $dto->productId,
                $dto->clientId,
            )
        );

        if (! $availability->isAvailable) {
            throw ProductIsNotAvailable::create();
        }

        // Issue product to client

        $this->eventBus->dispatch(
            new ProductIssuedEvent(
                $dto->productId,
                $dto->clientId,
            )
        );
    }
}