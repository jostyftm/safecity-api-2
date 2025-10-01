<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\AvailabilyZone\AvailabilyZoneController;
use App\Http\Controllers\Api\V1\ControlEntity\ControlEntityController;
use App\Http\Controllers\Api\V1\ControlEntity\ControlEntityUserController;
use App\Http\Controllers\Api\V1\Incident\IncidentCategoryController;
use App\Http\Controllers\Api\V1\Incident\IncidentController;
use App\Http\Controllers\Api\V1\Province\ProvinceController;
use App\Http\Controllers\Api\V1\User\UserController;
use App\Models\AvailabilyZone;
use Dedoc\Scramble\Scramble;
use Illuminate\Support\Facades\Route;

Scramble::registerUiRoute(path: 'docs', api: 'default');
Scramble::registerJsonSpecificationRoute(path: '/docs/v1/api.json', api: 'default');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password/{token}', function () {})->name('password.reset');
Route::post('reset-password', [AuthController::class, 'resetUpdatePassword'])->name('password.update');

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::apiResource('users', UserController::class);
    Route::apiResource('incidentCategories', IncidentCategoryController::class);

    Route::apiResource('incidents', IncidentController::class);
    Route::post('incidents/{incident}/verify', [IncidentController::class, 'verify'])->name('incidents.verify');
    Route::post('incidents/{incident}/auto-assign', [IncidentController::class, 'autoAssign'])->name('incidents.auto-assign');

    Route::apiResource('controlEntities', ControlEntityController::class);
    Route::apiResource('controlEntities.users', ControlEntityUserController::class);
    Route::apiResource('controlEntities.availabilyZones', AvailabilyZoneController::class)->only(['index', 'store']);
    Route::apiResource('availabilyZones', AvailabilyZoneController::class)->only(['show', 'update', 'destroy']);

    Route::apiResource('provinces', ProvinceController::class);
});
