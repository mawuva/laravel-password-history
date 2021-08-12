<?php

namespace Mawuekom\PasswordHistory;

use Illuminate\Support\ServiceProvider;

class PasswordHistoryServiceProvider extends ServiceProvider
{
    private $_packageTag = 'password-history';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'password-history');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/password-history.php' => config_path('password-history.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/password-history.php', 'password-history');

        // Register the main class to use with the facade
        $this->app->singleton('password-history', function () {
            return new PasswordHistory;
        });
    }
}
