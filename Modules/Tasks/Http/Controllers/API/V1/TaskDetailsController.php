<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Interfaces\TasksRepository;
use Modules\Tasks\Transformers\TaskTransformer;
use function request;
use function response;

/**
 * Class TasksController.
 */
class TaskDetailsController extends Controller
{
    /**
     * @var TasksRepository
     */
    protected $repository;

    /**
     * TasksController constructor.
     *
     * @param  TasksRepository  $repository
     */
    public function __construct(TasksRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $slug)
    {
        $task = $this->repository->findBySlug($slug);

        $isAuthorized = Auth::user()->ability(['Super Admin', 'manger'], ['read_task'])
            || Auth::user()->isEmployeeManger()
            || in_array($task->id, Auth::user()->allUserTasksIdsAsArray())
            || in_array($task->space_id, Auth::user()->allUserWorkspacesIdsAsArray());

        if (! $isAuthorized) {
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $task->load(['comments', 'comments.user', 'comments.replies', 'comments.replies.user', 'comments.parent', 'assignedUsers', 'media', 'histories']);

        $formattedTask = (new TaskTransformer)->transform($task);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $formattedTask,
            ]);
        }
    }
}
