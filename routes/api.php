<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\ImageController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Area
// Route::apiResource('areas', AreaController::class);

// Article
// Route::apiResource('articles', ArticleController::class);

// Auth
Route::post('auth/register', [AuthenticateController::class, 'register']);
Route::post('auth/login', [AuthenticateController::class, 'login']);


// Rutas con token
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::apiResource('areas', AreaController::class);
    Route::apiResource('articles', ArticleController::class);
    Route::post('images', [ImageController::class, 'store']);
    Route::post('auth/logout', [AuthenticateController::class, 'logout']);
    Route::get('auth/users', [AuthenticateController::class, 'index']);
});