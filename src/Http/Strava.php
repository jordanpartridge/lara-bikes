<?php

namespace jordanpartridge\StravaIntegration\Http;

use Saloon\Http\Connector;

class Strava extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://www.strava.com/api/v3';
    }

    public function defaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer '.config('strava.access_token'),
        ];
    }
}
