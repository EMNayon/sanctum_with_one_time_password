<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgetPasswordController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);
Route::post('login',[LoginController::class, 'login']);

Route::post('password/forget-password', [ForgetPasswordController::class, 'forgetPassword']);
Route::post('password/reset', [ResetPasswordController::class, 'passwordReset']);



Route::middleware(['auth:sanctum'])->group(function(){
    Route::post("email-verification", [EmailVerificationController::class, 'email_verification']);
    Route::get("email-verification", [EmailVerificationController::class, 'sendEmailVerification']);
});