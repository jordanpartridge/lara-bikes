<?php

return [
    'strava' => [
        'client_id' => env('STRAVA_CLIENT_ID'),
        'client_secret' => env('STRAVA_CLIENT_SECRET'),
        'scope' => 'read,activity:read_all',
        'authorize_url' => 'https://www.strava.com/oauth/authorize',
    ],
];
