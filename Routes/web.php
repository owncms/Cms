<?php

use \Backend\DomainController;
use \Backend\LanguageController;

Route::prefix('cms')->name('cms.')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::resource('domains', DomainController::class);
        Route::resource('languages', LanguageController::class);
    });
});
