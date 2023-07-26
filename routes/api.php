<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WaitlistController;
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

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

// APIs under Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/admin/logout', [AdminLoginController::class, 'logout']);

    Route::apiResource('/articles', ArticleController::class);
});

// Guest APIs
Route::prefix('guest')->group(function () {
    Route::get('articles', [ArticleController::class, 'index']);
    Route::get('articles/{article}', [ArticleController::class, 'show']);
});

// Admin Auth APIs
Route::prefix('admin')->group(function () {
    Route::post('register', [AdminRegisterController::class, 'register']);
    Route::post('login', [AdminLoginController::class, 'login']);
});

// Waitlist
Route::post('waitlist/create', [WaitlistController::class, 'store']);
