<?php
namespace App\Services;

use App\Services\Contracts\LoadCalculatorInterface;
use Exception;

class LoadCalculatorFactory
{
    public static function make(string $type): LoadCalculatorInterface
    {
        return match(strtolower($type)) {
            'maize' => app(MaizeLoadCalculator::class),
            // 'wheat' => app(WheatLoadCalculator::class),
            // 'oats'  => app(OatsLoadCalculator::class),
            default => throw new Exception("Tipo de carga no soportado: $type"),
        };
    }
}
