<?php

namespace App\Services\Contracts;

interface LoadCalculatorInterface
{
    public function calculate(array $load): array;
}
