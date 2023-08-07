<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\Mentors\MentorLoginController;
use App\Http\Controllers\Auth\Mentors\MentorRegisterController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // logout routes
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/admin/logout', [AdminLoginController::class, 'logout']);
    Route::post('/mentor/logout', [MentorLoginController::class, 'logout']);
    // -------------

});

// User auth APIs
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

// Mentor auth APIs 
Route::prefix('mentor')->group(function () {
    Route::post('register', [MentorRegisterController::class, 'register']);
    Route::post('login', [MentorLoginController::class, 'login']);
});

// Admin Auth APIs
Route::prefix('admin')->group(function () {
    Route::post('register', [AdminRegisterController::class, 'register']);
    Route::post('login', [AdminLoginController::class, 'login']);
});
