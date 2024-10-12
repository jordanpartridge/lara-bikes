<?php

namespace jordanpartridge\StravaIntegration\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \jordanpartridge\StravaIntegration\StravaIntegration
 */
class StravaIntegration extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \jordanpartridge\StravaIntegration\StravaIntegration::class;
    }
}
