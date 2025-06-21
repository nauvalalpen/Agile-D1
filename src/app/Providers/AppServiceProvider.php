<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\SettingsHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register SettingsHelper as singleton
        $this->app->singleton('settings.helper', function ($app) {
            return new SettingsHelper();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Add any boot logic here
    }
}
