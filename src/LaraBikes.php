<?php

namespace JordanPartridge\LaraBikes;

use JordanPartridge\LaraBikes\Contracts\Stravable;
use JordanPartridge\LaraBikes\Http\Requests\Activities;
use JordanPartridge\LaraBikes\Http\Requests\TokenExchange;
use JordanPartridge\LaraBikes\Http\Strava;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

readonly class LaraBikes
{
    public function __construct(private Strava $strava) {}

    public function refreshToken(string $client_id, string $client_secret, string $refresh_token): Response
    {
        return $this->strava->refreshToken($client_id, $client_secret, $refresh_token);
    }

    public function tokenForUser(Stravable $user): ?string
    {
        $tokenExchange = new TokenExchange(
            [
                'grant_type' => 'access_token',
                'client_id' => $user->getClientId(),
                'client_secret' => $user->getClientSecret(),
            ]
        );

        $response = $this->strava->send($tokenExchange);

        return $response->json()['access_token'];
    }

    /**
     * Get an activity by its ID.
     *
     * @param  int  $id  - The Strava activity ID.
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function activity(int $id): Response
    {
        return $this->strava->send(new Activities($id));
    }
}
