<?php

declare(strict_types=1);

namespace Client\Application\Exception;

use RuntimeException;

final class ClientNotFound extends RuntimeException
{
    public static function byId(int $id): self
    {
        return new self(
            sprintf('Client with id %d not found.', $id)
        );
    }
}