<?php

namespace jordanpartridge\StravaIntegration\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use jordanpartridge\LaraBikes\LaraBikesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'jordanpartridge\\StravaIntegration\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaraBikesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_strava-integration_table.php.stub';
        $migration->up();
        */
    }
}
