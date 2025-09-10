<?php

namespace App\Services;

use App\Services\Contracts\QuantityCalculatorInterface;

class QuantityCalculator implements QuantityCalculatorInterface
{
    public function calculate(float $quantity, float $factor): array
    {
        $adjust = round($quantity * (1 - $factor), 2);
        $total = round($quantity - $adjust, 2);

        return [
            'adjust' => $adjust,
            'total' => $total,
        ];
    }
}
