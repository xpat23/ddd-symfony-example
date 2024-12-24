<?php

declare(strict_types=1);

namespace Product\Domain\Event;

interface EventBus
{
    public function dispatch(object $event): void;
}