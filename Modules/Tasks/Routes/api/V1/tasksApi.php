
<?php

use Illuminate\Support\Facades\Route;
use Modules\Tasks\Http\Controllers\API\V1\UpdateTasksController;
use RahulHaque\Filepond\Http\Controllers\FilepondController;
use Modules\Tasks\Http\Controllers\API\V1\TasksController;
use Modules\Tasks\Http\Controllers\API\V1\TasksCommentsController;
use Modules\Tasks\Http\Controllers\API\V1\TaskDetailsController;
use Modules\Tasks\Http\Controllers\API\V1\TasksWorkspacesController;
use Modules\Tasks\Http\Controllers\API\V1\TasksTimersController;
use Modules\Tasks\Http\Controllers\API\V1\CompanyUsersController;
use Modules\Tasks\Http\Controllers\API\V1\TasksStatusesController;
use Modules\Tasks\Http\Controllers\API\V1\WorkspaceLinksController;
use Modules\Tasks\Http\Controllers\API\V1\TasksWorkspaceUsersController;
use Modules\Tasks\Http\Controllers\API\V1\TasksStatusesHistoriesController;
use Modules\Tasks\Http\Controllers\API\V1\workspaceListsController;
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

Route::resource('tasks', TasksController::class);
Route::get('task/get_task_byslug/{slug}', TaskDetailsController::class)->name('get_task_byslug');
Route::resource('comments', TasksCommentsController::class);
Route::resource('tasks_statuses', TasksStatusesController::class);
Route::resource('tasks_statuses_histories', TasksStatusesHistoriesController::class);
Route::resource('tasks_timers', TasksTimersController::class);
Route::resource('tasks_workspaces', TasksWorkspacesController::class);
Route::get('company_users_list', CompanyUsersController::class)->name('company_users_list');
Route::post('workspace_users_list', TasksWorkspaceUsersController::class)->name('workspace_users_list');

// control of task processes
Route::post('update_task_periority/{task_id}', [UpdateTasksController::class, 'updatePeriority']);
Route::post('update_task_status/{task_id}', [UpdateTasksController::class, 'updateStatus']);
Route::post('reorder_tasks', [UpdateTasksController::class, 'reorderTasks']);
Route::post('update_progress', [UpdateTasksController::class, 'updateProgress']);
Route::resource('workspace_links', WorkspaceLinksController::class);

// to make custom transformer
Route::post('space_tasks_lists', workspaceListsController::class);

Route::post(config('tasks::filepond.server.url', '/media_upload'), [config('tasks::filepond.controller', FilepondController::class), 'process'])->name('filepond-process');
Route::patch(config('tasks::filepond.server.url', '/media_upload'), [config('tasks::filepond.controller', FilepondController::class), 'patch'])->name('filepond-patch');
Route::get(config('tasks::filepond.server.url', '/media_upload'), [config('tasks::filepond.controller', FilepondController::class), 'head'])->name('filepond-head');
Route::delete(config('tasks::filepond.server.url', '/media_upload'), [config('tasks::filepond.controller', FilepondController::class), 'revert'])->name('filepond-revert');
