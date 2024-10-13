<?php

namespace JordanPartridge\LaraBikes\Http\Controllers;
final class RedirectController
{
    public function __invoke()
    {

        $query = http_build_query([
            'client_id'     => config('lara-bikes.strava.client_id'),
            'redirect_uri'  => route('strava:callback'),
            'response_type' => 'code',
            'scope'         => config('lara-bikes.strava.scope'),
        ]);

        return redirect(config('lara-bikes.strava.authorize_url') . '?' . $query);
    }
}
