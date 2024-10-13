<?php

namespace JordanPartridge\LaraBikes\Http\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class AthleteActivityRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(
        private readonly array $payload,
    )
    {
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        $queryParams = [];
        foreach (['page', 'per_page'] as $param) {
            if (isset($this->payload[$param])) {
                $queryParams[$param] = urlencode($this->payload[$param]);
            }
        }
        return '/athlete/activities?' . http_build_query($queryParams);
    }

    public function resolveQuery(): array
    {
        $allowedParams = ['page', 'per_page'];
        return array_intersect_key($this->payload, array_flip($allowedParams));
    }
}
