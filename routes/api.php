<?php

use App\Http\Controllers\Api\V1\BusinessController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * API Routes V1
 */
Route::group([
    'prefix' => 'v1',
    'as' => 'api.v1.',
    'namespace' => 'App\Http\Controllers\Api\V1',
], static function () {

    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::group(['name' => "Authenticated", 'middleware' => 'auth:sanctum'], static function () {
        Route::get('/user', static function (Request $request) {
            return $request->user();
        })->middleware('auth:sanctum');


        Route::apiResource('users', UserController::class);
        Route::apiResource('businesses', BusinessController::class);
    });


});
