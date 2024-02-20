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

Route::group(['prefix' => 'utils'], function () {
    Route::post('contact', [App\Http\Controllers\LandingController::class, 'contact']);
    Route::get('estados', [App\Http\Controllers\LandingController::class, 'states']);
    Route::get('ciudades', [App\Http\Controllers\LandingController::class, 'cities']);
    Route::get('centros', [App\Http\Controllers\Centros\CentroAcopioController::class, 'findByLocation']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
    Route::post('forgot-password', [App\Http\Controllers\Auth\AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [App\Http\Controllers\Auth\AuthController::class, 'resetPassword']);
    
    Route::group( ['middleware' => ['auth:sanctum']], function() {
        Route::get('is-logged-in', [App\Http\Controllers\Auth\AuthController::class, 'isLoggeIn']);
        Route::post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
    });
});

// CONSULTAS INDIVIDUALES
Route::middleware('auth:sanctum')->group(function() {
    // USERS
    Route::group(['prefix' => 'users'], function () {
        Route::post('register', [App\Http\Controllers\Users\UserController::class, 'store']);
        Route::post('activar/{user}', [App\Http\Controllers\Users\UserController::class, 'activarUser']);
        Route::post('desactivar/{user}', [App\Http\Controllers\Users\UserController::class, 'desactivarUser']);
        Route::post('getByRoleName', [App\Http\Controllers\Users\UserController::class, 'getUsersByRole']);
    });
    // CENTROS DE ACOPIO
    Route::group(['prefix' => 'centro-acopio'], function () {
        Route::get('index', [App\Http\Controllers\Centros\CentroAcopioController::class, 'index']);
        Route::get('show/{centro_id}', [App\Http\Controllers\Centros\CentroAcopioController::class, 'show']);
        Route::post('store', [App\Http\Controllers\Centros\CentroAcopioController::class, 'store']);
    });
});

// API RESOURCES
Route::middleware('auth:sanctum')->group(function() {

});
