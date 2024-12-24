<?php

declare(strict_types=1);

namespace Product\Infrastructure\Controller;

use Product\Application\Dto\CheckProductAvailabilityForClientDto;
use Product\Application\Dto\IssueProductToClientDto;
use Product\Application\Exception\ProductIsNotAvailable;
use Product\Application\Service\CheckProductAvailabilityForClientService;
use Product\Application\Service\IssueProductToClientService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

readonly class ProductController
{
    public function __construct(
        private CheckProductAvailabilityForClientService $checkService,
        private IssueProductToClientService $issueService,
    ) {
    }

    #[Route('/product/{productId}/availability/{clientId}', name: 'product_availability', methods: ['GET'])]
    public function checkAvailability(int $productId, int $clientId): Response
    {
        $availability = $this->checkService->execute(
            new CheckProductAvailabilityForClientDto(
                $productId,
                $clientId
            )
        );

        return new JsonResponse(
            $availability,
            Response::HTTP_OK,
        );
    }

    #[Route('/product/{productId}/issue/{clientId}', name: 'product_issue', methods: ['POST'])]
    public function issueProductToClient(int $productId, int $clientId): Response
    {
        try {
            $this->issueService->execute(
                new IssueProductToClientDto(
                    $productId,
                    $clientId
                )
            );

            return new JsonResponse(
                ['message' => 'Product issued to client'],
                Response::HTTP_OK,
            );
        } catch (ProductIsNotAvailable $ex) {
            return new JsonResponse(
                ['error' => $ex->getMessage()],
                Response::HTTP_BAD_REQUEST,
            );
        } catch (Throwable $ex) {
            return new JsonResponse(
                ['error' => $ex->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR,
            );
        }
    }

}