<?php

declare(strict_types=1);

namespace Client\Domain\ValueObject;

use InvalidArgumentException;

readonly class Contact
{
    public function __construct(private string $email, private string $phone)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Invalid email');
        }

        if (! preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone)) {
            throw new InvalidArgumentException('Invalid phone number');
        }
    }

    public function email(): string
    {
        return $this->email;
    }

    public function phone(): string
    {
        return $this->phone;
    }

}