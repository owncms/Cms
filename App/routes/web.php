<?php

use \Backend\CmsDomainController;
use \Backend\CmsLanguageController;

Route::prefix('cms')->name('cms.')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::resource('domains', CmsDomainController::class);
        Route::resource('languages', CmsLanguageController::class);
    });
});
