<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Interfaces\TasksStatuseRepository;
use function request;
use function response;
use function view;

/**
 * Class workspaceListsController.
 */
class workspaceListsController extends Controller
{
    /**
     * @var TasksRepository
     */
    protected $repository;

    /**
     * TasksController constructor.
     *
     * @param  TasksRepository  $repository
     * @param  TaskValidator  $validator
     */
    public function __construct(TasksStatuseRepository $repository)
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
        $lists = $this->repository->
        with('tasks', 'tasks.assigneds', 'tasks.comments', 'tasks.childrens', 'tasks.parent')
            ->findByField('space_id', $request->workspace_id);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $lists,
            ]);
        }
//        return view('tasks::index', compact('tasks'));
    }
}
