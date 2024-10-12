<?php

namespace jordanpartridge\StravaIntegration\Commands;

use Illuminate\Console\Command;

class StravaIntegrationCommand extends Command
{
    public $signature = 'strava-integration';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
