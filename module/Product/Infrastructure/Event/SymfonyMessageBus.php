<?php

declare(strict_types=1);

namespace Product\Infrastructure\Event;

use Product\Domain\Event\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;

readonly class SymfonyMessageBus implements EventBus
{
    public function __construct(
        private MessageBusInterface $messageBus
    ) {
    }

    public function dispatch(object $event): void
    {
        $this->messageBus->dispatch($event);
    }
}