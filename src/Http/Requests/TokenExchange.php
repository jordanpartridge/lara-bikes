<?php

namespace JordanPartridge\LaraBikes\Http\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Illuminate\Support\Facades\Validator;

class TokenExchange extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    private array $configuration;

    public function __construct(array $configuration)
    {
        $this->configuration = $this->validateConfig($configuration);
    }

    private function validateConfig(array $config): array
    {
        $validator = Validator::make($config, [
            'grant_type' => 'required|in:authorization_code,refresh_token',
            'client_id' => 'required|string',
            'client_secret' => 'required|string',
            'code' => 'required_if:grant_type,authorization_code|string',
            'refresh_token' => 'required_if:grant_type,refresh_token|string',
        ]);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $validator->validated();
    }

    public function resolveEndpoint(): string
    {
        return '/oauth/token';
    }

    public function defaultBody(): array
    {
        /**
         * Note this is not an update or create I got a little confused at once point
         * it is in fact dealing with authorization codes and refresh tokens
         */
        return $this->configuration['grant_type'] === 'authorization_code'
            ? [
                'client_id' => $this->configuration['client_id'],
                'client_secret' => $this->configuration['client_secret'],
                'code' => $this->configuration['code'],
                'grant_type' => $this->configuration['grant_type'],
            ]
            : [
                'client_id' => $this->configuration['client_id'],
                'client_secret' => $this->configuration['client_secret'],
                'refresh_token' => $this->configuration['refresh_token'],
                'grant_type' => $this->configuration['grant_type'],
            ];
    }
}
