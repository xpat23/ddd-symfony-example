<?php

declare(strict_types=1);

namespace Notification\Application\Dto;

readonly class SendEmailNotificationDto
{
    public function __construct(
        public string $email,
        public string $subject,
        public string $body
    ) {
    }
}