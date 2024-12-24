<?php

declare(strict_types=1);

namespace Tests\Product\Domain\Service\ProductAvailabilityChecking;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Product\Domain\Service\ProductAvailabilityChecking\MonthlyIncomeBasedCheckingService;
use Product\Domain\Service\ProductAvailabilityChecking\ProductAvailabilityCheckingService;
use Product\Domain\ValueObject\ProductAvailability;
use Tests\Product\Domain\Stub\StubClientBuilder;
use Tests\Product\Domain\Stub\StubProductBuilder;

class MonthlyIncomeBasedCheckingServiceTest extends TestCase
{
    public static function data(): array
    {
        return [
            [
                'monthlyIncome' => 499,
                'minimumMonthlyIncome' => 500,
                'expectedAvailability' => false,
                'expectedInterestRate' => 0,
            ],
            [
                'monthlyIncome' => 1000,
                'minimumMonthlyIncome' => 1000,
                'expectedAvailability' => true,
                'expectedInterestRate' => 5.8,
            ],
            [
                'monthlyIncome' => 1010,
                'minimumMonthlyIncome' => 1000,
                'expectedAvailability' => true,
                'expectedInterestRate' => 5.8,
            ],
            [
                'monthlyIncome' => 501,
                'minimumMonthlyIncome' => 500,
                'expectedAvailability' => true,
                'expectedInterestRate' => 5.8,
            ],
        ];
    }

    #[Test]
    #[DataProvider('data')]
    public function it_checks_availability_by_monthly_income(
        float $monthlyIncome,
        float $minimumMonthlyIncome,
        bool $expectedAvailability,
        float $expectedInterestRate,
    ): void {
        $decorated = $this->createStub(ProductAvailabilityCheckingService::class);

        $decorated->method('checkAvailability')
            ->willReturn(
                new ProductAvailability(true, 5.8),
            );

        $it = new MonthlyIncomeBasedCheckingService(
            $decorated,
            $minimumMonthlyIncome,
        );

        $client = StubClientBuilder::create()
            ->withMonthlyIncome($monthlyIncome)->build();

        $product = StubProductBuilder::create()
            ->build();

        $availability = $it->checkAvailability($product, $client);

        $this->assertEquals($expectedInterestRate, $availability->interestRate());
        $this->assertEquals($expectedAvailability, $availability->isAvailable());
    }
}
