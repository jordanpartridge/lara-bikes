<?php

namespace jordanpartridge\StravaIntegration;

use jordanpartridge\StravaIntegration\Http\Requests\Activities;
use jordanpartridge\StravaIntegration\Http\Strava;

class StravaIntegration
{
    public function __construct(private Strava $strava)
    {}

    public function test()
    {
        return 'some test';
        

    }

    public  function activities()
    {
        return $this->strava->send(new Activities(1));
    }
}
