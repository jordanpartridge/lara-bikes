<?php

namespace JordanPartridge\LaraBikes\Database\Factories\LaraBikes\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JordanPartridge\LaraBikes\Database\Factories\LaraBikes\LaraBikes
 */
class LaraBikes extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LaraBikes::class;
    }
}
