<?php

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
    Route::post('forgot-password', [App\Http\Controllers\Auth\AuthController::class, 'forgotPassword']);
    Route::get('verifyPin', [App\Http\Controllers\Auth\AuthController::class, 'verifyPin']);
    
    Route::group( ['middleware' => ['auth:sanctum']], function() {
        Route::post('reset-password', [App\Http\Controllers\Auth\AuthController::class, 'resetPassword']);
        Route::get('is-logged-in', [App\Http\Controllers\Auth\AuthController::class, 'isLoggeIn']);
        Route::post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
    });
});

// CONSULTAS INDIVIDUALES
Route::middleware('auth:sanctum')->group(function() {
    Route::post('users/register', [App\Http\Controllers\Users\UserController::class, 'store']);
    Route::post('users/activar/{user}', [App\Http\Controllers\Users\UserController::class, 'activarUser']);
    Route::post('users/desactivar/{user}', [App\Http\Controllers\Users\UserController::class, 'desactivarUser']);
    Route::post('users/getByRoleName', [App\Http\Controllers\Users\UserController::class, 'getUsersByRole']);
});

// API RESOURCES
Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('users', App\Http\Controllers\Users\UserController::class);
});
