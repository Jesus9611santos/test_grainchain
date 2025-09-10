<?php

namespace App\Providers;

use App\Services\PriceCalculator;
use App\Services\QuantityCalculator;
use App\Services\MaizeLoadCalculator;
use App\Services\MoistureFactorService;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\MoistureFactorInterface;
use App\Services\Contracts\PriceCalculatorInterface;
use App\Services\Contracts\QuantityCalculatorInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Interfaces de cálculo
        $this->app->bind(MoistureFactorInterface::class, MoistureFactorService::class);
        $this->app->bind(QuantityCalculatorInterface::class, QuantityCalculator::class);
        $this->app->bind(PriceCalculatorInterface::class, PriceCalculator::class);

        // Calculadores de carga
        $this->app->bind(MaizeLoadCalculator::class, function ($app) {
            return new MaizeLoadCalculator(
                $app->make(MoistureFactorService::class),
                $app->make(QuantityCalculator::class),
                $app->make(PriceCalculator::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
