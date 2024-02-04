<?php

namespace App\Providers;

use App\Service\DivisionService;
use App\Service\ProfileService;
use Illuminate\Support\ServiceProvider;

class MainServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ProfileService::class, function ($app) {
            return new ProfileService($app);
        });

        $this->app->singleton(DivisionService::class, function ($app) {
            return new DivisionService($app);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
