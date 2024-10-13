<?php

namespace JordanPartridge\LaraBikes\Http\Controllers;

use Illuminate\Http\Request;
use jordanpartridge\LaraBikes\Http\Requests\TokenExchange;
use jordanpartridge\LaraBikes\Http\Strava;

final class CallbackController
{
    public function __construct(private Strava $strava) {}

    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'string'],
        ]);

        $response = $this->strava->send(new TokenExchange($validated['code']));

        if (! $response->ok()) {
            return response(['error' => 'Failed to exchange token'], 500);
        }

        return response(['token' => $response->json()['access_token']]);
    }
}
