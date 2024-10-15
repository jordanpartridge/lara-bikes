<?php

use JordanPartridge\LaraBikes\Models\StravaClient;

it('encrypts the client secret', function () {
    $client = StravaClient::factory()->create([
        'client_secret' => 'secret',
    ]);
    expect($client->client_secret)->toBe('secret');
});
