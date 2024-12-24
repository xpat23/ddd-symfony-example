<?php

declare(strict_types=1);

namespace Tests\Product\Domain\Service\ProductAvailabilityChecking;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Product\Domain\Service\ProductAvailabilityChecking\IncreasedRateForStatesService;
use Product\Domain\Service\ProductAvailabilityChecking\ProductAvailabilityCheckingService;
use Product\Domain\ValueObject\ProductAvailability;
use Tests\Product\Domain\Stub\StubClientBuilder;
use Tests\Product\Domain\Stub\StubProductBuilder;

class IncreasedRateForStatesServiceTest extends TestCase
{

    public static function data(): array
    {
        return [
            [
                [
                    'NY' => 1.5,
                    'CA' => 1.8,
                ],
                7.0,
            ],
            [
                [
                    'TX' => 1.5,
                    'CA' => 1.5,
                ],
                5.5,
            ],
            [
                [
                    'TX' => 1.5,
                    'NY' => 2.3,
                ],
                7.8,
            ],
            [
                [
                    'NY' => 11.49,
                ],
                16.99,
            ],
        ];
    }

    #[DataProvider('data')]
    #[Test]
    public function it_increases_rate_for_some_states(
        array $increaseRates,
        float $expectedRate
    ): void {
        $decorated = $this->createStub(ProductAvailabilityCheckingService::class);
        $decorated
            ->method('checkAvailability')
            ->willReturn(
                new ProductAvailability(true, 5.5)
            );

        $product = StubProductBuilder::create()->build();
        $client = StubClientBuilder::create()->withAddressState('NY')->build();
        $service = new IncreasedRateForStatesService($decorated, $increaseRates);

        $availability = $service->checkAvailability($product, $client);

        $this->assertEquals($expectedRate, round($availability->interestRate(), 2));
        $this->assertTrue($availability->isAvailable());
    }
}
