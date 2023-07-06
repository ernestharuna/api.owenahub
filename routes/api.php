<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\auth\AdminLoginController;
use App\Http\Controllers\auth\AdminRegisterController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::post('/admin/logout', [AdminLoginController::class, 'logout']);

    Route::apiResource('/articles', ArticleController::class);
});

Route::get('guest/articles', [ArticleController::class, 'index']);
Route::post('/admin/register', [AdminRegisterController::class, 'register']);
Route::post('/admin/login', [AdminLoginController::class, 'login']);
