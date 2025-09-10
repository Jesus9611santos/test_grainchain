<?php
// app/Services/MoistureFactorService.php
namespace App\Services;

use App\Services\Contracts\MoistureFactorInterface;
use Exception;

class MoistureFactorService implements MoistureFactorInterface
{
    private array $intervals = [
        ['lower' => 0,    'upper' => 12,   'factor' => 1],
        ['lower' => 12,   'upper' => 12.6, 'factor' => 0.98],
        ['lower' => 12.6, 'upper' => 13.2, 'factor' => 0.96],
        ['lower' => 13.2, 'upper' => 14,   'factor' => 0.94],
        ['lower' => 14,   'upper' => 17,   'factor' => 0.90],
    ];

    public function getFactor(float $moisture): float
    {
        if ($moisture < 12 || $moisture > 17) {
            throw new Exception("Humedad fuera del rango permitido (12-17%).");
        }

        foreach ($this->intervals as $interval) {
            if ($moisture > $interval['lower'] && $moisture <= $interval['upper']) {
                return $interval['factor'];
            }
        }

        throw new Exception("Error al calcular el factor de humedad.");
    }
}
