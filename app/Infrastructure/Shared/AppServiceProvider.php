<?php

namespace App\Infrastructure\Shared;

use App\Infrastructure\Services\PetService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PetService::class, function () {
            return new PetService(config('services.pet_store_api_service.pet_store_api_key'));
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
