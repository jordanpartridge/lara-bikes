<?php

namespace jordanpartridge\LaraBikes;

use jordanpartridge\LaraBikes\Http\Requests\Activities;
use jordanpartridge\LaraBikes\Http\Strava;

class LaraBikes
{
    public function __construct(private Strava $strava) {}

    public function test()
    {
        return 'some test';

    }

    public function activities()
    {
        return $this->strava->send(new Activities(1));
    }
}
