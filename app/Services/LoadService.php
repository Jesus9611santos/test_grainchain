<?php
// app/Services/LoadService.php
namespace App\Services;

class LoadService
{
    public function calculateTotalValue(array $loads, string $type): array
    {
        $calculator = LoadCalculatorFactory::make($type);

        return collect($loads)->map(fn($load) => $calculator->calculate($load))->toArray();
    }
}
