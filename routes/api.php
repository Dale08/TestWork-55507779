<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api;

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

Route::middleware('auth:api')->group(function () {
    Route::apiResource('/categories', Api\CategoryController::class);
    Route::get( '/book/search', [Api\BookController::class, 'search']);
    Route::apiResource('/books', Api\BookController::class);
});
