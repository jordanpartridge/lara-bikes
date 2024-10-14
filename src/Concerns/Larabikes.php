<?php

namespace JordanPartridge\LaraBikes\Concerns;

trait Larabikes
{
    public function getAthleteId(): int
    {
        return $this->stravaClient->athleteId;
    }

    public function stravaClient()
    {
        return $this->hasOne(StravaClient::class);
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
