<?php

declare(strict_types=1);

namespace Client\Infrastructure\Controller;

use Client\Application\Dto\CreateClientDto;
use Client\Application\Dto\UpdateClientDto;
use Client\Application\Exception\ClientNotFound;
use Client\Application\Service\CreateClientService;
use Client\Application\Service\UpdateClientService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Throwable;

readonly class ClientController
{

    public function __construct(
        private CreateClientService $createClient,
        private UpdateClientService $updateClient
    ) {
    }

    #[Route('/client', name: 'client_create', methods: ['POST'])]
    public function create(#[MapRequestPayload] CreateClientDto $dto): Response
    {
        try {
            $this->createClient->execute($dto);

            return new JsonResponse('Client created', Response::HTTP_CREATED);
        } catch (Throwable $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    #[Route('/client/{id}', name: 'client_update', methods: ['PUT'])]
    public function update(int $id, #[MapRequestPayload] UpdateClientDto $dto): Response
    {
        try {
            $this->updateClient->execute($id, $dto);

            return new JsonResponse('Client updated', Response::HTTP_OK);
        } catch (ClientNotFound $e) {
            return new JsonResponse($e->getMessage(), Response::HTTP_NOT_FOUND);
        } catch (Throwable $e) {
            return new JsonResponse('Error updating client: ' . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}