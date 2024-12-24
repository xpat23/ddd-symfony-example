<?php

declare(strict_types=1);

namespace Product\Application\Service;

use Product\Application\Dto\CheckProductAvailabilityForClientDto;
use Product\Application\Dto\ProductAvailabilityDto;
use Product\Domain\Repository\ClientRepository;
use Product\Domain\Repository\ProductRepository;
use Product\Domain\Service\ProductAvailabilityChecking\ProductAvailabilityCheckingService;
use RuntimeException;

readonly class CheckProductAvailabilityForClientService
{
    public function __construct(
        private ProductAvailabilityCheckingService $checkingService,
        private ClientRepository $clients,
        private ProductRepository $products
    ) {
    }

    public function execute(CheckProductAvailabilityForClientDto $dto): ProductAvailabilityDto
    {
        $client = $this->clients->findById($dto->clientId);
        $product = $this->products->findById($dto->productId);

        if ($client === null) {
            throw new RuntimeException('Client not found.');
        }

        if ($product === null) {
            throw new RuntimeException('Product not found.');
        }

        $availability = $this->checkingService->checkAvailability($product, $client);

        return new ProductAvailabilityDto(
            $availability->isAvailable(),
            round($availability->interestRate(), 2)
        );
    }
}