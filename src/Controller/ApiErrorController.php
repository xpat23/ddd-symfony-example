<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Throwable;

final class ApiErrorController
{
    public function show(Throwable $exception): JsonResponse
    {
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode(
        ) : Response::HTTP_INTERNAL_SERVER_ERROR;

        $data = [
            'error' => true,
            'message' => $exception->getMessage(),
            'code' => $statusCode,
        ];

        $previous = $exception->getPrevious();
        if ($previous instanceof ValidationFailedException) {
            foreach ($previous->getViolations() as $violation) {
                $data['violations'][] = [
                    'property' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage(),
                ];
            }
        }

        if ($_ENV['APP_ENV'] === 'dev') {
            $data['trace'] = $exception->getTrace();
        }

        return new JsonResponse($data, $statusCode);
    }
}