<?php

namespace JordanPartridge\LaraBikes\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
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

        $this->runMigrations();
    }

    protected function runMigrations(): void
    {
        $migrationFiles = File::glob(__DIR__.'/../database/migrations/*.php.stub');
        $testMigrations = File::glob(__DIR__.'/migrations/*.php');

        collect(array_merge($testMigrations, $migrationFiles))
            ->map(fn ($file) => File::getRequire($file))
            ->each(fn ($migration) => $migration->up());
    }
}
