<?php

namespace App\Services;

use App\Services\Contracts\LoadCalculatorInterface;
use Exception;

class MaizeLoadCalculator implements LoadCalculatorInterface
{
    private float $pricePerKg;
    private MoistureFactorService $factorService;
    private QuantityCalculator $quantityCalculator;
    private PriceCalculator $priceCalculator;

    public function __construct(
        MoistureFactorService $factorService,
        QuantityCalculator $quantityCalculator,
        PriceCalculator $priceCalculator
    ) {
        $this->pricePerKg = env('PRICE', 6);
        $this->factorService = $factorService;
        $this->quantityCalculator = $quantityCalculator;
        $this->priceCalculator = $priceCalculator;
    }

    public function calculate(array $load): array
    {
        $factor = $this->factorService->getFactor($load['moisture']);
        $quantities = $this->quantityCalculator->calculate($load['quantity'], $factor);
        $value = $this->priceCalculator->calculate($quantities['total'], $this->pricePerKg);

        return [
            'id' => $load['id'],
            'quantity' => $load['quantity'],
            'adjust' => $quantities['adjust'],
            'total' => $quantities['total'],
            'value' => $value,
        ];
    }
}
