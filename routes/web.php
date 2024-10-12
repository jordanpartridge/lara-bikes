<?php

Route::prefix('strava')->as('strava:')->group(function () {
    Route::get('redirect', RedirectController::class)->name('redirect');
    Route::get('callback', CallbackController::class)->name('callback');
});
