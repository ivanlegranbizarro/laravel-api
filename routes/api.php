<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class)->only(['store', 'update', 'destroy']);
    Route::group(['prefix' => 'products'], function () {
        Route::apiResource('{product}/reviews', ReviewController::class)->only(['store', 'update', 'destroy']);
    });
});


Route::apiResource('products', ProductController::class)->only(['index', 'show']);

Route::group(['prefix' => 'products'], function () {
    Route::apiResource('{product}/reviews', ReviewController::class)->only(['index', 'show']);
});
