<?php

use App\Http\Controllers\Merchant\{Category\CategoryController, Auth\AuthController, Auth\ProfileController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Merchant API V1 Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API V1 routes for Merchant. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::controller(ProfileController::class)->middleware(['auth:sanctum', 'ability:merchant'])
    ->group(function () {
        Route::get('{id}', 'getProfile');
        Route::post('{id}', 'updateProfile');
        Route::delete('{id}', 'deleteProfile');
    });

Route::apiResources([
    'category' => CategoryController::class,
]);
