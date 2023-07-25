<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);

Route::post('login',[LoginController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post("email-verification", [EmailVerificationController::class, 'email_verification']);
});