<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Modules\Tasks\Events\TaskStatusUpdated;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Interfaces\TasksRepository;
use function response;

/**
 * Class UpdateTaskInfoController.
 */
class UpdateTasksController extends Controller
{
    /**
     * TasksController constructor.
     *
     * @param  TasksRepository  $repository
     * @param  TaskValidator  $validator
     */
    public function __construct(TasksRepository $repository, Request $request)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePeriority(Request $request, $task_id)
    {
        if (! isset($request->task_id)) {
            return;
        }

        $updatedTask = $this->repository->update($request->priority, $request->task_id);

        return response()->json([
            'data' => $updatedTask,
            'message' => ' تم تحديث التاسك بنجاح ',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateProgress(Request $request, $task_id)
    {
        if (! isset($request->task_id)) {
            return;
        }

        $updatedTask = $this->repository->update($request->progress, $request->task_id);

        return response()->json([
            'data' => $updatedTask,
            'message' => ' تم تحديث التاسك بنجاح ',
        ]);
    }

    public function updateStatus(Request $request, $task_id)
    {
        if (! isset($request->task_id)) {
            return;
        }

        $updatedTask = $this->repository->update($request->status_id, $request->task_id);

        event(new TaskStatusUpdated($updatedTask));

        return response()->json([
            'data' => $updatedTask,
            'message' => ' تم تحديث التاسكات بنجاح ',
        ]);
    }

    public function reorderTasks(Request $request)
    {
        if (! isset($request->tasks)) {
            return;
        }

        $updatedTasks = $this->repository->reorderTasks($request->tasks);

        return response()->json([
            'data' => $updatedTasks,
            'message' => ' تم تحديث التاسكات بنجاح ',
        ]);
    }

    public function syncAssignedUsers(Request $request)
    {
        $updatedTasks = $this->repository->reorderTasks($request->tasks);

        return response()->json([
            'data' => $updatedTasks,
            'message' => ' تم تحديث التاسكات بنجاح ',
        ]);
    }
}
