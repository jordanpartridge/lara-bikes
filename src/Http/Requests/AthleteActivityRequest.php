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
        private array $payload,
    ) {
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/athlete/activities?page=' . $this->payload['page'] . '&per_page=' . $this->payload['per_page'];
    }

    public function resolveQuery(): array
    {
        return $this->payload;
    }
}
