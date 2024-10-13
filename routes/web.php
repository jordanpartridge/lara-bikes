<?php

use JordanPartridge\LaraBikes\Http\Controllers\CallbackController;
use JordanPartridge\LaraBikes\Http\Controllers\RedirectController;

Route::prefix('strava')->middleware('web')->as('strava:')->group(function () {
    Route::get('redirect', RedirectController::class)->name('redirect');
    Route::get('callback', CallbackController::class)->name('callback');
});

    Route::prefix('strava')->middleware('web')->as('strava:')->group(function () {
        Route::get('redirect', RedirectController::class)->name('redirect');
        Route::get('callback', CallbackController::class)->name('callback');
    });


