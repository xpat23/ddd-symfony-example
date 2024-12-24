<?php

declare(strict_types=1);

namespace Product\Domain\Service;

readonly class RandomizerService
{
    public function next(): bool
    {
        return (bool)random_int(0, 1);
    }
}