<?php

namespace jordanpartridge\LaraBikes;

use jordanpartridge\LaraBikes\Commands\LaraBikesCommand;
use jordanpartridge\StravaIntegration\Http\Strava;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaraBikesServiceProvider extends PackageServiceProvider
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
            ->hasCommand(LaraBikesCommand::class)
            ->hasRoutes(['web', 'api'])
            ->hasTranslations()
            ->hasAssets();

        $this->registerServices();
        $this->registerFacades();
        $this->registerMiddleware();
    }

    private function registerServices(): void
    {
        $this->app->singleton(LaraBikes::class, function ($app) {
            return new StravaIntegration(new Strava());
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
