<?php

declare(strict_types=1);

namespace Notification\Application\Service;

use Notification\Application\Dto\SendEmailNotificationDto;
use Psr\Log\LoggerInterface;

final class SendEmailNotificationService
{
    public function __construct(
        private LoggerInterface $logger
    ) {
    }

    public function execute(SendEmailNotificationDto $dto): void
    {
        $this->logger->info(
            sprintf(
                'Sending email to: %s. With subject: %s. With body: %s',
                $dto->email,
                $dto->subject,
                $dto->body
            )
        );
    }
}