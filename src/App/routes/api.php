<?php

use App\Admin\Bestellingen\Controllers\BestelController;
use App\Admin\Bestellingen\Controllers\OrderItemsController;
use App\Admin\Klanten\Controllers\KlantenController;
use App\Admin\Producten\Controllers\ProductController;
use App\Admin\Restaurants\Controllers\RestaurantController;
use App\Api\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth:api'],
], static function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('bestellingen', BestelController::class);
    Route::apiResource('orderItems', OrderItemsController::class);
    Route::apiResource('producten', ProductController::class);
    Route::apiResource('restaurants', RestaurantController::class);
    Route::apiResource('klanten', KlantenController::class);
});
