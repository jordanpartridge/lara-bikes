<?php

namespace JordanPartridge\LaraBikes\Concerns;

use JordanPartridge\LaraBikes\Models\StravaClient;

/**
 * @method hasOne(string $class)
 */
trait LaraBikes
{
    public function stravaClient()
    {
        return $this->hasOne(StravaClient::class);
    }

    public function getAthleteId(): int
    {
        return $this->stravaClient->athleteId;
    }


    public function getClientId(): string
    {
        return $this->stravaClient->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->stravaClient->clientSecret;
    }

}
