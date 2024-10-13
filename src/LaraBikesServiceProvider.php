<?php

namespace jordanpartridge\LaraBikes;

use jordanpartridge\LaraBikes\Commands\LaraBikesCommand;
use jordanpartridge\LaraBikes\Http\Strava;
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
            ->name('lara-bikes')
            ->hasConfigFile()
            ->hasViews()
            // ->hasMigration('create_strava_integration_table')
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
            return new LaraBikes(new Strava);
        });

    }

    private function registerFacades(): void
    {
        $this->app->alias(LaraBikes::class, 'lara-bikes');
    }

    private function registerMiddleware(): void
    {
        // Register any middleware if needed
    }
}
