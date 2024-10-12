<?php

namespace jordanpartridge\StravaIntegration;

use jordanpartridge\StravaIntegration\Commands\StravaIntegrationCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class StravaIntegrationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('strava')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_strava_integration_table')
            ->hasCommand(StravaIntegrationCommand::class)
            ->hasRoutes(['web', 'api'])
            ->hasTranslations()
            ->hasAssets();

        $this->registerServices();
        $this->registerFacades();
        $this->registerMiddleware();
    }

    private function registerServices(): void
    {
        $this->app->singleton(StravaIntegration::class, function ($app) {
            return new StravaIntegration(config('strava-integration'));
        });
    }

    private function registerFacades(): void
    {
        $this->app->alias(StravaIntegration::class, 'strava-integration');
    }

    private function registerMiddleware(): void
    {
        // Register any middleware if needed
    }
}
