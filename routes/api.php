<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;

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

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/get', [UserController::class, 'getUsers']);
        Route::post('/create', [UserController::class, 'createUser']);
        Route::post('/login', [UserController::class, 'loginUser']);
    });

    Route::group(['prefix' => 'food'], function () {
        Route::get('/get', [FoodController::class, 'getAllFoodClass']);
        Route::post('/create', [FoodController::class, 'createFoodClass']);
    });
});
