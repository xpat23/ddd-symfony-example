<?php

declare(strict_types=1);

namespace Tests\Product\Domain\Service\ProductAvailabilityChecking;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Product\Domain\Service\ProductAvailabilityChecking\ProductAvailabilityCheckingService;
use Product\Domain\Service\ProductAvailabilityChecking\RandomAvailabilityForStatesService;
use Product\Domain\Service\RandomizerService;
use Product\Domain\ValueObject\ProductAvailability;
use Tests\Product\Domain\Stub\StubClientBuilder;
use Tests\Product\Domain\Stub\StubProductBuilder;

class RandomAvailabilityForStatesServiceTest extends TestCase
{
    public static function data(): array
    {
        return [
            ['NY', true, true, 100],
            ['NY', false, false, 0],
            ['CA', true, true, 100],
            ['CA', false, false, 0],
            ['TX', true, true, 100],
            ['TX', false, true, 100],
        ];
    }

    #[DataProvider('data')]
    #[Test]
    public function it_returns_false_availability_for_some_states_random(
        string $clientState,
        bool $randomizerResult,
        bool $expectedAvailability,
        float $expectedRate
    ): void {
        $decorated = $this->createStub(ProductAvailabilityCheckingService::class);
        $randomizer = $this->createStub(RandomizerService::class);
        $states = ['NY', 'CA'];

        $service = new RandomAvailabilityForStatesService($decorated, $randomizer, $states);

        $product = StubProductBuilder::create()->build();
        $client = StubClientBuilder::create()->withAddressState($clientState)->build();

        $randomizer->method('next')->willReturn($randomizerResult);

        $decorated
            ->method('checkAvailability')
            ->willReturn(
                new ProductAvailability(true, 100)
            );

        $availability = $service->checkAvailability(
            $product,
            $client
        );

        $this->assertEquals($expectedAvailability, $availability->isAvailable());
        $this->assertEquals($expectedRate, $availability->interestRate());
    }
}
