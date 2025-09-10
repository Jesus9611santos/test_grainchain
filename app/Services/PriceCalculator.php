<?php

namespace App\Services;

use App\Services\Contracts\PriceCalculatorInterface;

class PriceCalculator implements PriceCalculatorInterface
{
    public function calculate(float $total, float $pricePerKg): float
    {
        return round($total * $pricePerKg, 2);
    }
}
