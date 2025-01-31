<?php

namespace infinety\AuditLogger\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use infinety\AuditLogger\AuditServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends Orchestra
{
    use WithFaker;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    protected function getPackageProviders($app)
    {
        return [
            AuditServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        // This will run your package migrations
        // (assuming they can be autoloaded or included)
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }
}
