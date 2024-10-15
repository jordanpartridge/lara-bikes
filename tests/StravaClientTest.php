<?php

use JordanPartridge\LaraBikes\Models\StravaClient;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('encrypts the client secret', function () {
    $client = StravaClient::factory()->create([
        'client_secret' => 'secret',
    ]);

    expect($client->getAttributes()['client_secret'])->not->toBe('secret')
        ->and($client->client_secret)->toBe('secret');
});

it('has unique client ids', function () {
    StravaClient::factory()->create([
        'client_id' => '1234567890',
    ]);

    expect(fn () => StravaClient::factory()->create([
        'client_id' => '1234567890',
    ]))->toThrow(QueryException::class, 'UNIQUE constraint failed');
});

it('allows creation of clients with different client ids', function () {
    $client1 = StravaClient::factory()->create([
        'client_id' => '1234567890',
    ]);

    $client2 = StravaClient::factory()->create([
        'client_id' => '0987654321',
    ]);

    expect($client1->client_id)->toBe('1234567890')
        ->and($client2->client_id)->toBe('0987654321');
});

it('requires a client id', function () {
    expect(fn () => StravaClient::factory()->create([
        'client_id' => null,
    ]))->toThrow(QueryException::class, 'NOT NULL constraint failed');
});

