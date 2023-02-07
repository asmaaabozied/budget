<?php

use Illuminate\Support\Facades\Route;
use Modules\Tasks\Http\Controllers\API\V1\Auth\AuthController;

/*
 *api  Auth Controllers
 * All route names are prefixed with 'Api\Auth'.
 */

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'user']);
});
