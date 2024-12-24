<?php

declare(strict_types=1);

namespace Product\Infrastructure\Event;

use Client\Application\Service\GetClientByIdService;
use Notification\Application\Dto\SendEmailNotificationDto;
use Notification\Application\Service\SendEmailNotificationService;
use Product\Domain\Event\ProductIssuedEvent;
use Product\Domain\Repository\ProductRepository;
use RuntimeException;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class SendEmailOnProductIssuedEventHandler
{
    public function __construct(
        private GetClientByIdService $clientByIdService,
        private SendEmailNotificationService $notificationService,
        private ProductRepository $products
    ) {
    }

    public function __invoke(ProductIssuedEvent $event): void
    {
        $client = $this->clientByIdService->execute($event->clientId());

        if ($client === null) {
            throw new RuntimeException('Client not found');
        }

        $product = $this->products->findById($event->productId());

        if ($product === null) {
            throw new RuntimeException('Product not found.');
        }

        $this->notificationService->execute(
            new SendEmailNotificationDto(
                $client->email,
                'Product issued',
                sprintf(
                    'Product %s has been issued to you. With rate %d.',
                    $product->name(),
                    $product->interestRate()
                )
            )
        );
    }
}