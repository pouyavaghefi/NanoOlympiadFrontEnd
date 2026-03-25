<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CourseValidationService;
use App\Services\EpisodeValidationService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register CourseValidationService as a singleton
        $this->app->singleton(CourseValidationService::class, function ($app) {
            return new CourseValidationService();
        });

        // Register EpisodeValidationService as a singleton
        $this->app->singleton(EpisodeValidationService::class, function ($app) {
            return new EpisodeValidationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
