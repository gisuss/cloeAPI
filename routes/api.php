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
    Route::post('contact', [App\Http\Controllers\UtilsController::class, 'contact']);
    Route::get('estados', [App\Http\Controllers\UtilsController::class, 'states']);
    Route::post('ciudades', [App\Http\Controllers\UtilsController::class, 'cities']);
    Route::get('municipios', [App\Http\Controllers\UtilsController::class, 'municipios']);
    Route::post('centros', [App\Http\Controllers\Centros\CentroAcopioController::class, 'findByLocation']);
    Route::get('brands', [App\Http\Controllers\UtilsController::class, 'getBrands']);
    Route::get('lines', [App\Http\Controllers\UtilsController::class, 'getLineas']);
    Route::get('categories', [App\Http\Controllers\UtilsController::class, 'getCategories']);
    Route::get('materiales', [App\Http\Controllers\UtilsController::class, 'getMaterials']);
    Route::get('procesos', [App\Http\Controllers\UtilsController::class, 'getProcesses']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [App\Http\Controllers\Auth\AuthController::class, 'login']);
    Route::post('forgot-password', [App\Http\Controllers\Auth\AuthController::class, 'forgotPassword']);
    Route::post('reset-password', [App\Http\Controllers\Auth\AuthController::class, 'resetPassword']);
    
    Route::group( ['middleware' => ['auth:sanctum']], function() {
        Route::post('refresh-token', [App\Http\Controllers\Auth\AuthController::class, 'refreshToken']);
        Route::get('profile-info', [App\Http\Controllers\Auth\AuthController::class, 'profileInfo']);
        Route::post('logout', [App\Http\Controllers\Auth\AuthController::class, 'logout']);
        Route::get('is-logged-in', [App\Http\Controllers\Auth\AuthController::class, 'isLoggeIn']);
    });
});

// CONSULTAS INDIVIDUALES
Route::middleware('auth:sanctum')->group(function() {
    // DASHBOARD
    Route::get('dashboard', [App\Http\Controllers\Dashboard\DashboardController::class, 'index']);

    // USERS
    Route::group(['prefix' => 'users'], function () {
        Route::get('index', [App\Http\Controllers\Users\UserController::class, 'index']);
        Route::get('report-pdf', [App\Http\Controllers\Users\UserController::class, 'reportPDF']);
        Route::get('report-excel', [App\Http\Controllers\Users\UserController::class, 'reportExcel']);
        Route::get('show/{user}', [App\Http\Controllers\Users\UserController::class, 'show']);
        Route::post('register', [App\Http\Controllers\Users\UserController::class, 'store']);
        Route::put('update/{user}', [App\Http\Controllers\Users\UserController::class, 'update']);
        Route::post('activate/{user}', [App\Http\Controllers\Users\UserController::class, 'activarUser']);
        Route::post('desactivate/{user}', [App\Http\Controllers\Users\UserController::class, 'desactivarUser']);
        Route::post('getByRoleName', [App\Http\Controllers\Users\UserController::class, 'getUsersByRole']);
        Route::post('first-reset-password/{user}', [App\Http\Controllers\Users\UserController::class, 'firstResetPassword']);
        Route::delete('delete/{user}', [App\Http\Controllers\Users\UserController::class, 'destroy']);
    });

    // CARGOS
    Route::group(['prefix' => 'cargos'], function () {
        Route::get('/', [App\Http\Controllers\UtilsController::class, 'getRoles']);
    });

    // CENTROS DE ACOPIO
    Route::group(['prefix' => 'centro-acopio'], function () {
        Route::get('index', [App\Http\Controllers\Centros\CentroAcopioController::class, 'index']);
        Route::get('report-pdf', [App\Http\Controllers\Centros\CentroAcopioController::class, 'reportPDF']);
        Route::get('report-excel', [App\Http\Controllers\Centros\CentroAcopioController::class, 'reportExcel']);
        Route::get('show/{centro_id}', [App\Http\Controllers\Centros\CentroAcopioController::class, 'show']);
        Route::post('store', [App\Http\Controllers\Centros\CentroAcopioController::class, 'store']);
        Route::put('update/{centro_id}', [App\Http\Controllers\Centros\CentroAcopioController::class, 'update']);
    });

    // MODULO DE CLASIFICACION
    Route::group(['prefix' => 'raee'], function () {
        Route::get('index', [App\Http\Controllers\Raees\RaeeController::class, 'index']);
        Route::get('report-pdf', [App\Http\Controllers\Raees\RaeeController::class, 'reportPDF']);
        Route::get('report-excel', [App\Http\Controllers\Raees\RaeeController::class, 'reportExcel']);
        Route::post('store', [App\Http\Controllers\Raees\RaeeController::class, 'store']);
        Route::get('show/{raee_id}', [App\Http\Controllers\Raees\RaeeController::class, 'show']);
        Route::put('update/{raee_id}', [App\Http\Controllers\Raees\RaeeController::class, 'update']);
        Route::delete('delete/{raee_id}', [App\Http\Controllers\Raees\RaeeController::class, 'destroy']);
    });

    // MODULO DE SEPARACION
    Route::group(['prefix' => 'split'], function () {
        Route::get('index', [App\Http\Controllers\Components\ComponentController::class, 'index']);
        Route::get('report-pdf', [App\Http\Controllers\Components\ComponentController::class, 'reportPDF']);
        Route::get('report-excel', [App\Http\Controllers\Components\ComponentController::class, 'reportExcel']);
        Route::post('store', [App\Http\Controllers\Components\ComponentController::class, 'store']);
        Route::get('show/{raee_id}', [App\Http\Controllers\Components\ComponentController::class, 'show']);
        Route::put('update/{raee_id}', [App\Http\Controllers\Components\ComponentController::class, 'update']);
    });
    
    // MODULO DE COMPONENTES
    Route::group(['prefix' => 'components'], function () {
        Route::get('index', [App\Http\Controllers\Elements\ElementController::class, 'index']);
        Route::get('report-pdf', [App\Http\Controllers\Elements\ElementController::class, 'reportPDF']);
        Route::get('report-excel', [App\Http\Controllers\Elements\ElementController::class, 'reportExcel']);
        Route::post('store', [App\Http\Controllers\Elements\ElementController::class, 'store']);
        Route::get('show/{raee_id}', [App\Http\Controllers\Elements\ElementController::class, 'show']);
        Route::put('update/{component_id}', [App\Http\Controllers\Elements\ElementController::class, 'update']);
        Route::delete('delete/{component_id}', [App\Http\Controllers\Elements\ElementController::class, 'destroy']);
    });
});

// API RESOURCES
Route::middleware('auth:sanctum')->group(function() {

});
