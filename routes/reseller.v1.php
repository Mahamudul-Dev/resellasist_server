<?php

use App\Http\Controllers\Reseller\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Reseller API V1 Routes
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
