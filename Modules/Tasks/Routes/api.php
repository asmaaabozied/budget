<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/task', function (Request $request) {
//    return $request->user();
//});

// not needed with api , we will detect lang from request params
//Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

Route::prefix('v1')->group(function () {
    Route::prefix('tasks')->group(function () {
        Route::prefix('auth')->group(__DIR__.'/api/V1/Auth/authRoutes.php'); // API Auth Routes

        // protect all  incoming api requests routes and a third party requestes are protected with sanctum guard
        Route::middleware('auth:sanctum')->group(function () {
            require_once __DIR__.'/api/V1/tasksApi.php';
            require_once __DIR__.'/api/V1/notifications.php';
        });
    });
});
//});
