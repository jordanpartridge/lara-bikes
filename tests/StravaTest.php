<?php

use JordanPartridge\LaraBikes\Http\Strava;
use JordanPartridge\LaraBikes\Tests\User;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    actingAs(User::factory()->make());
});

it('has access to the authenticated user', function () {
    $strava = app(Strava::class);
    expect($strava->authenticated())->toBe(true);
});

it('requires authentication', function () {
    $user = User::factory()->make();
    actingAs($user);
    $strava = app(Strava::class);
    expect($strava->resolveBaseUrl())->toBe('https://www.strava.com/api/v3');
});

it('throws a proper error when client_id is invalid', function () {
    $user = User::factory()->make();
    actingAs($user);
    $strava = app(Strava::class);

    expect(fn () => $strava->refreshToken('blah', 'secret', '23423'))
        ->toThrow(Exception::class, 'Failed to refresh token. Bad Request: client_id is invalid');
});

it('throws a proper error when client_secret is invalid', function () {
    $user = User::factory()->make();
    actingAs($user);
    $strava = app(Strava::class);
    expect(fn () => $strava->refreshToken('12345', 'blah', '23423'))
        ->toThrow(
            Exception::class,
            'Failed to refresh token. Unauthorized: Invalid access token'
        );

});
