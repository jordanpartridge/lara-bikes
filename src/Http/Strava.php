<?php

namespace JordanPartridge\LaraBikes\Http;

use Illuminate\Contracts\Auth\Authenticatable;
use JordanPartridge\LaraBikes\Http\Requests\TokenExchange;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Traits\OAuth2\AuthorizationCodeGrant;
use Saloon\Traits\Plugins\AcceptsJson;

class Strava extends Connector
{
    use AcceptsJson;
    use AuthorizationCodeGrant;

    public function __construct(private Authenticatable $user) {}

    /**
     * @throws FatalRequestException
     * @throws RequestException
     * @throws \JsonException
     */
    public function refreshToken($client_id, $client_secret, $refresh_token): Response
    {
        $config = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
        ];
        $request = new TokenExchange($config);
        $response = $this->send($request);

        if ($response->failed()) {
            $this->handleErrorResponse($response);
        }

        $responseData = $response->json();
        if (! isset($responseData['access_token'])) {
            throw new \Exception('Access token not found in response');
        }

        $this->token = $responseData['access_token'];

        return $response;
    }

    public function authenticated(): bool
    {
        return $this->user instanceof Authenticatable;
    }

    /**
     * Handle error responses from the API
     *
     * @throws \Exception
     */
    private function handleErrorResponse(Response $response): void
    {
        $statusCode = $response->status();
        $errors = $response->json('errors');

        $errorMessage = $this->getMessageForStatusCode($statusCode, $errors);

        throw new \Exception("Failed to refresh token. $errorMessage");
    }

    public function resolveBaseUrl(): string
    {

        return 'https://www.strava.com/api/v3';
    }

    private function getMessageForStatusCode(int $statusCode, mixed $errors)
    {
        if ($statusCode === 400) {
            $error = 'Bad Request: ';
            $field = $errors[0]['field'] ?? null;
            $code = $errors[0]['code'] ?? null;
            if ($field && $code) {
                $error .= "$field is $code";
            }

            return $error;
        }
        if ($statusCode === 401) {
            return 'Unauthorized: Invalid access token';
        }

        return 'unimplemented: '.$statusCode;
    }
}
