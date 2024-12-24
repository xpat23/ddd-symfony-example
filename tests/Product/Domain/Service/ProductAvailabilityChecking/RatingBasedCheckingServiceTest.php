<?php

declare(strict_types=1);

namespace Tests\Product\Domain\Service\ProductAvailabilityChecking;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Product\Domain\Service\ProductAvailabilityChecking\RatingBasedCheckingService;
use Tests\Product\Domain\Stub\StubClientBuilder;
use Tests\Product\Domain\Stub\StubProductBuilder;

class RatingBasedCheckingServiceTest extends TestCase
{
    public static function data(): array
    {
        return [
            [499, 5.8, 0, false],
            [500, 5.8, 5.8, true],
            [501, 2.8, 2.8, true],
        ];
    }

    #[Test]
    #[DataProvider('data')]
    public function it_checks_availability_by_rating(
        int $rating,
        float $interestRate,
        float $expectedInterestRate,
        bool $expectedAvailability,
    ): void {
        $it = new RatingBasedCheckingService(500);

        $client = StubClientBuilder::create()
            ->withRating($rating)->build();

        $product = StubProductBuilder::create()
            ->withInterestRate($interestRate)
            ->build();

        $availability = $it->checkAvailability($product, $client);

        $this->assertEquals($expectedInterestRate, $availability->interestRate());
        $this->assertEquals($expectedAvailability, $availability->isAvailable());
    }
}
