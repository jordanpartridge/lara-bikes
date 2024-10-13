<?php

namespace JordanPartridge\LaraBikes\Http\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class TokenExchange extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::POST;

    /**
     * The code from the Strava OAuth flow, either an authorization code or a refresh token
     */
    private string $code;

    private string $client_id;

    private string $client_secret;

    private string $refresh_token;

    /**
     * The type of grant being exchanged
     */
    private string $grant_type;

    public function __construct(array $config)
    {
        // pull values from config
        $this->code = $config['code'];
        $this->grant_type = $config['grant_type'];
        $this->client_id = $config['client_id'];
        $this->client_secret = $config['client_secret'];
        $this->refresh_token = $config['refresh_token'];
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
        return $this->grant_type === 'authorization_code'
            ? [
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'code' => $this->code,
                'grant_type' => $this->grant_type,
            ]
            : [
                'refresh_token' => $this->refresh_token,
            ];
    }
}
