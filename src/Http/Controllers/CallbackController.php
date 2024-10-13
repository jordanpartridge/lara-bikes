<?php

namespace JordanPartridge\LaraBikes\Http\Controllers;

use Illuminate\Http\Request;
use JordanPartridge\LaraBikes\Http\Requests\TokenExchange;
use JordanPartridge\LaraBikes\Http\Strava;
use JordanPartridge\LaraBikes\Models\StravaToken;

final readonly class CallbackController
{
    public function __construct(private Strava $strava) {}

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string'],
            'client_id' => ['required', 'string'],
            'client_secret' => ['required', 'string'],
            'grant_type' => ['required', 'string'],
        ]);

        $response = $this->strava->send(new TokenExchange($validated));

        if (! $response->ok()) {
            return response(['error' => 'Failed to exchange token'], 500);
        }

        StravaToken::create([
            'access_token' => $response->json()['access_token'],
            'expires_at' => now()->addSeconds($response->json()['expires_in']),
            'refresh_token' => $response->json()['refresh_token'],
            'athlete_id' => $response->json()['athlete']['id'],
            'user_id' => $request->user()->id,
        ]);

        return redirect('/admin');
    }
}
