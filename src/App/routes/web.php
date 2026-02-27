<?php

use App\Admin\User\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

// Socialite
Route::group(['prefix' => 'auth/{provider}'], function () {
    Route::get('redirect', [SocialiteController::class, 'redirect'])->name('auth.socialite.redirect');
    Route::get('callback', [SocialiteController::class, 'callback'])->name('auth.socialite.callback');
});
