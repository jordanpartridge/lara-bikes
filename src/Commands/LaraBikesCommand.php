<?php

namespace jordanpartridge\LaraBikes\Commands;

use Illuminate\Console\Command;

class LaraBikesCommand extends Command
{
    public $signature = 'lara-bikes';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
