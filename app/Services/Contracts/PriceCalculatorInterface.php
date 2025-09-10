<?php

namespace App\Services\Contracts;

interface PriceCalculatorInterface
{
    public function calculate(float $total, float $pricePerKg): float;
}
