<?php

namespace JordanPartridge\LaraBikes\Commands;

use Illuminate\Console\Command;

class LaraBikesCommand extends Command
{
    public $signature = 'lara-bikes:install';

    public $description = 'Handles the installation of the package';

    public function handle(): int
    {
        $this->info('Setting up LaraBikes...');
        $this->info('Installing dependencies...');
        $this->call('vendor:publish', ['--provider' => 'JordanPartridge\LaraBikes\LaraBikesServiceProvider']);
        $this->info('Dependencies installed successfully.');
        $this->info('Running migrations...');
        $this->call('migrate');
        $this->info('Migrations completed successfully.');

        return self::SUCCESS;
    }
}
