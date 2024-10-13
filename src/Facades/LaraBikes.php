<?php

namespace jordanpartridge\LaraBikes\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \jordanpartridge\LaraBikes\LaraBikes
 */
class LaraBikes extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LaraBikes::class;
    }
}
