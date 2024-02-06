<?php

namespace App\Providers;

use App\Service\ClubService;
use App\Service\DateRunService;
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

        $this->app->singleton(DateRunService::class, function ($app) {
            return new DateRunService($app);
        });

        $this->app->singleton(DivisionService::class, function ($app) {
            return new DivisionService($app);
        });

        $this->app->singleton(ClubService::class, function ($app) {
            return new ClubService($app);
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
