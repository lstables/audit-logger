<?php

namespace infinety\AuditLogger;

use Illuminate\Support\ServiceProvider;
use infinety\AuditLogger\Observers\AuditObserver;

class AuditServiceProvider extends ServiceProvider
{
    /**
     * Register any package services.
     */
    public function register()
    {
        // Merge default package config if needed
        $this->mergeConfigFrom(
            __DIR__ . '/../config/audit.php',
            'audit'
        );
    }

    /**
     * Bootstrap any package services.
     */
    public function boot()
    {
        // Publish the migration
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'my-audit-migrations');

        // Publish the config
        $this->publishes([
            __DIR__ . '/../config/audit.php' => config_path('audit.php'),
        ], 'my-audit-config');

        // Optionally, auto-register your observer for specified models (if desired)
        // For example, if your config file has a list of models to be audited:
        if (config('audit.auto_observe')) {
            $models = config('audit.models', []);
            foreach ($models as $modelClass) {
                // This uses Eloquent's observe() method
                $modelClass::observe(AuditObserver::class);
            }
        }
    }
}
