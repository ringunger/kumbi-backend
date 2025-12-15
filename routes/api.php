<?php

use App\Http\Controllers\Api\V1\BusinessController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

/**
 * API Routes V1
 */
Route::group([
    'prefix' => 'v1',
    'as' => 'api.v1.',
    'namespace' => 'App\Http\Controllers\Api\V1',
], static function () {


    Route::group(['name' => "Authenticated", 'middleware' => 'auth:sanctum'], function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('businesses', BusinessController::class);
    });


});
