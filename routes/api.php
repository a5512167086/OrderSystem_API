<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OrderController;

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
        Route::get('/get/{id}', [UserController::class, 'getUserById']);
        Route::post('/create', [UserController::class, 'createUser']);
        Route::post('/login', [UserController::class, 'loginUser']);
        Route::delete('/delete', [UserController::class, 'deleteUserById']);
        Route::patch('/update', [UserController::class, 'updateUserById']);
    });

    Route::group(['prefix' => 'food'], function () {
        Route::get('/get', [FoodController::class, 'getAllFoodClass']);
        Route::get('/get/{id}', [FoodController::class, 'getFoodClassById']);
        Route::post('/create', [FoodController::class, 'createFoodClass']);
        Route::delete('delete', [FoodController::class, 'deleteFoodClassById']);
        Route::patch('/update', [FoodController::class, 'updateFoodClassById']);

        Route::group(['prefix' => 'type'], function () {
            Route::get('/get', [FoodController::class, 'getAllFoodType']);
            Route::post('/create', [FoodController::class, 'createFoodType']);
            Route::delete('delete', [FoodController::class, 'deleteFoodTypeById']);
        });
    });

    Route::group(['prefix' => 'order'], function () {
        Route::get('/get', [OrderController::class, 'getAllOrders']);
        Route::post('/create', [OrderController::class, 'createNewOrder']);
    });
});
