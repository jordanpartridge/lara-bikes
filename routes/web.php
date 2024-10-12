<?php

use jordanpartridge\StravaIntegration\Http\Controllers\CallbackController;
use jordanpartridge\StravaIntegration\Http\Controllers\RedirectController;

Route::prefix('strava')->as('strava:')->group(function () {
    Route::get('redirect', RedirectController::class)->name('redirect');
    Route::get('callback', CallbackController::class)->name('callback');
});
