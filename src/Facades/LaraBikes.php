<?php

namespace jordanpartridge\StravaIntegration\Facades;

use Illuminate\Support\Facades\Facade;
use jordanpartridge\LaraBikes\LaraBikes;

/**
 * @see \jordanpartridge\StravaIntegration\StravaIntegration
 */
class StravaIntegration extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LaraBikes::class;
    }
}
