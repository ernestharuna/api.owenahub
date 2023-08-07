<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MentorController;
use App\Http\Controllers\SessionController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('/articles', ArticleController::class);
    Route::apiResource('/mentors', MentorController::class);
    Route::apiResource('/sessions', SessionController::class);
});

// Guest APIs
Route::prefix('guest')->group(function () {
    Route::get('articles', [ArticleController::class, 'index']);
    Route::get('articles/{article}', [ArticleController::class, 'show']);

    Route::get('mentors', [MentorController::class, 'index']);

    Route::post('waitlist/create', [WaitlistController::class, 'store']);
});

require __DIR__ . '/auth.php';
