<?php

use Modules\Cms\Http\Controllers\Frontend\Auth\LoginController;
use Modules\Cms\Http\Controllers\Frontend\Auth\RegisterController;
use Modules\Cms\Http\Controllers\Frontend\ProfileController;
use Modules\Cms\Http\Controllers\Frontend\SearchController;
use Modules\Cms\Http\Controllers\Frontend\ShortLinkController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login_post');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register_post');
Route::get('search/{type}', [SearchController::class, 'search'])->name('search');

//auth
Route::group(['prefix' => 'my-account'], function () {
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
//    Route::group(['middleware' => ['auth']], function () {
        Route::get('profile', [ProfileController::class, 'dashboard'])->name('profile');
        Route::get('profile/change', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('profile/change', [ProfileController::class, 'update'])->name('profile.change');
//    });
});

Route::get('link/{hash}', [ShortLinkController::class, 'redirect'])->name('short_link.redirect');
