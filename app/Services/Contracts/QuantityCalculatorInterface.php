<?php

namespace App\Services\Contracts;

interface QuantityCalculatorInterface
{
    public function calculate(float $quantity, float $factor): array;
}
