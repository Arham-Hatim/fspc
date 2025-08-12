<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::get('logout', 'logout');
        Route::post('edit/profile', 'editProfile');
        Route::post('change/password', 'changePassword');
        Route::get('delete/user', 'deleteAccount');
    });
});

// user forgot verification
Route::middleware('guest')->group(function () {

    Route::controller(AuthController::class)->group(function () {
        Route::post('forgot/password', 'sendOtpForPasswordReset');
        Route::post('verify/otp/password', 'verifyOtpAndResetPassword');
    });

});

// user registration and login
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});
