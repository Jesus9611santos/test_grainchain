<?php

namespace App\Services\Contracts;

interface MoistureFactorInterface
{
    public function getFactor(float $moisture): float;
}
