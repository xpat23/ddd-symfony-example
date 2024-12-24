<?php

declare(strict_types=1);

namespace Product\Application\Exception;

use RuntimeException;

final class ProductIsNotAvailable extends RuntimeException
{
    public static function create(): self
    {
        return new self('Product is not available.');
    }
}