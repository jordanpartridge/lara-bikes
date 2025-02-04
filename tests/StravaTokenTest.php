<?php

use Illuminate\Support\Carbon;
use JordanPartridge\LaraBikes\Models\StravaToken;

it('can be created with factory default settings.', function () {
    $stravaToken = StravaToken::factory()->create();
    expect($stravaToken->access_token)->toBeString()->not()->toBeEmpty()
        ->and($stravaToken->refresh_token)->toBeString()->not()->toBeEmpty()
        ->and($stravaToken->created_at)->toBeInstanceOf(Carbon::class)
        ->and($stravaToken->updated_at)->toBeInstanceOf(Carbon::class)
        ->and($stravaToken->deleted_at)->toBeNull();
});
