<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Interfaces\TasksWorkspacesRepository;
use function request;
use function response;
use function view;

/**
 * Class TasksWorkspaceUsersController.
 */
class TasksWorkspaceUsersController extends Controller
{
    /**
     * TasksController constructor.
     *
     * @param  TasksRepository  $repository
     */

    public $repository;

    public function __construct(TasksWorkspacesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = [];

        if(request()->has('workspace_id')) {
            $workSpace = $this->repository->whereId(request()->get('workspace_id'))->first();
            $users = $workSpace->users()->get();
        }

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $users,
            ]);
        }
//        return view('tasks::index', compact('tasks'));
    }
}
