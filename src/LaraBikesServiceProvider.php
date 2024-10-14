<?php

namespace JordanPartridge\LaraBikes;

use Illuminate\Contracts\Auth\Authenticatable;
use JordanPartridge\LaraBikes\Commands\LaraBikesCommand;
use JordanPartridge\LaraBikes\Http\Strava;
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
            ->hasMigration('create_strava_tokens_table')
            ->hasMigration('create_strava_clients_table')
            ->hasCommand(LaraBikesCommand::class)
            ->hasRoutes(['web', 'api']);

        $this->registerServices();
        $this->registerFacades();
        $this->registerMiddleware();
    }

    private function registerServices(): void
    {
        $this->app->singleton(LaraBikes::class, function ($app) {
            return new LaraBikes(new Strava($app->auth->user()));
        });


        $this->app->bind(Strava::class, function ($app) {
            return new Strava($app->auth->user());
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
