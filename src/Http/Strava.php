<?php

namespace JordanPartridge\LaraBikes\Http;

use JordanPartridge\LaraBikes\Database\Factories\LaraBikes\Http\Requests\TokenExchange;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Traits\OAuth2\AuthorizationCodeGrant;
use Saloon\Traits\Plugins\AcceptsJson;

class Strava extends Connector
{
    use AcceptsJson;
    use AuthorizationCodeGrant;

    /**
     * The access token for the Strava API
     */
    private ?string $token;

    public function __construct(?string $token = null)
    {
        $this->token = $token;
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException|\JsonException
     */
    public function refreshToken($refresh): Response
    {
        $request     = new TokenExchange($refresh, 'refresh_token');
        $response    = $this->send($request);
        $this->token = $response->json()['access_token'];

        return $response;
    }

    /**
     * The Base URL of the API.
     */
    public function resolveBaseUrl(): string
    {
        return 'https://www.strava.com/api/v3';
    }

    /**
     * The OAuth2 configuration
     */
    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId('')
            ->setClientSecret('')
            ->setRedirectUri('')
            ->setDefaultScopes([])
            ->setAuthorizeEndpoint('authorize')
            ->setTokenEndpoint('token')
            ->setUserEndpoint('user');
    }

    /**
     * The default authenticator for the connector
     */
    protected function defaultAuth(): ?TokenAuthenticator
    {
        return $this->token ? new TokenAuthenticator($this->token) : null;
    }
}
