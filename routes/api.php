<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\BlogController;
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
// Route::get('/areas', [AreaController::class, 'index']);
// Route::post('/areas', [AreaController::class, 'store']);
// Route::get('/areas/{id}', [AreaController::class, 'show']);
// Route::put('/areas/{id}', [AreaController::class, 'update']);
// Route::delete('/areas/{id}', [AreaController::class, 'destroy']);

Route::apiResource('areas', AreaController::class);

// Blog
Route::get('/blogs', [BlogController::class, 'index']);
Route::post('/blogs', [BlogController::class, 'store']);
Route::get('/blogs/{id}', [BlogController::class, 'show']);
Route::put('/blogs/{id}', [BlogController::class, 'update']);
Route::delete('/blogs/{id}', [BlogController::class, 'destroy']);