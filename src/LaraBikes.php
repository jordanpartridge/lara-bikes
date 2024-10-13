<?php

namespace JordanPartridge\LaraBikes;

use JordanPartridge\LaraBikes\Http\Requests\Activities;
use JordanPartridge\LaraBikes\Http\Strava;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

readonly class LaraBikes
{
    public function __construct(private Strava $strava) {}

    /**
     * Get an activity by its ID.
     *
     * @param int $id - The Strava activity ID.
     *
     * @throws FatalRequestException
     * @throws RequestException
     *
     * @return Response
     */
    public function activity(int $id): Response
    {
        return $this->strava->send(new Activities($id));
    }
}
