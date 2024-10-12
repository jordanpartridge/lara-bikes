<?php

namespace jordanpartridge\StravaIntegration\Http\Requests;

use Saloon\Traits\Plugins\HasJsonBody;

use Saloon\Http\Request;

class TokenExchange extends Request implements HasJsonBody
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    /**
     * The code from the Strava OAuth flow, either an authorization code or a refresh token
     */
    private string $code;

    /**
     * The type of grant being exchanged
     */
    private string $grant_type;

    public function __construct(string $code, string $grant_type = 'authorization_code')
    {
        $this->code = $code;
        $this->grant_type = $grant_type;
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/oauth/token';
    }

    /**
     * The request body
     */
    public function defaultBody(): array
    {
        return $this->grant_type === 'authorization_code' ? [
            'client_id'     => config('strava.client_id'),
            'client_secret' => config('strava.client_secret'),
            'code'          => $this->code,
            'grant_type'    => $this->grant_type,
        ] : [
            'client_id'     => config('strava.client_id'),
            'client_secret' => config('strava.client_secret'),
            'refresh_token' => $this->code,
            'grant_type'    => $this->grant_type,
        ];
    }
}
