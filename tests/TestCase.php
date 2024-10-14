<?php

namespace JordanPartridge\LaraBikes\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use JordanPartridge\LaraBikes\LaraBikesServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'JordanPartridge\\LaraBikes\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaraBikesServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app): void
    {
        config()->set('database.default', 'testing');

        $migration = include __DIR__.'/../database/migrations/create_strava_tokens_table.php.stub';
        $migration->up();

    }
}
