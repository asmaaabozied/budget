<?php

use Modules\Tasks\Http\Controllers\API\V1\TasksController;
use Illuminate\Support\Facades\Route;

// to get auth user
Route::middleware('web', 'auth')->group(function () {
    Route::prefix(LaravelLocalization::setLocale())->middleware('localeSessionRedirect', 'localizationRedirect', 'localeViewPath')->group(function () {
        Route::prefix('dashboard/tasks')->group(function () {
            Route::get('/', [TasksController::class, 'index'])->name('tasks.board');

            // just for users inside budget app , we will use web and auth not sanctum to avoid problems with auth in tasks
              //  require_once 'tasksWeb.php';
        });
    });
});
