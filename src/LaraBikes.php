<?php

namespace JordanPartridge\LaraBikes;

use JordanPartridge\LaraBikes\Http\Requests\Activities;
use JordanPartridge\LaraBikes\Http\Strava;
use Saloon\Http\Response;

readonly class LaraBikes
{
    public function __construct(private Strava $strava) {}


    public function activities(int $id): Response
    {
        return $this->strava->send(new Activities($id));
    }
}
