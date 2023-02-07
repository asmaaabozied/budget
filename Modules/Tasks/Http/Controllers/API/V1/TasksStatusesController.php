<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use function app;
use App\Http\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Http\Controllers\Response;
use Modules\Tasks\Http\Requests\TasksStatuseCreateRequest;
use Modules\Tasks\Http\Requests\TasksStatuseUpdateRequest;
use Modules\Tasks\Interfaces\TasksStatuseRepository;
use Prettus\Validator\Exceptions\ValidatorException;
use function redirect;
use function request;
use function response;
use function view;

/**
 * Class TasksStatusesController.
 */
class TasksStatusesController extends Controller
{
    /**
     * @var TasksStatuseRepository
     */
    protected $repository;

    /**
     * TasksStatusesController constructor.
     *
     * @param  TasksStatuseRepository  $repository
     * @param  TasksStatuseValidator  $validator
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
    public function index(Request $request)
    {
        $isAuthorized = Auth::user()->ability(['Super Admin', 'manger'], ['read_tasks_statuse'])
            || in_array($request->workspace_id, Auth::user()->allUserWorkspacesIds());

        if (! $isAuthorized) {
            if ($request->expectsJson()) {
                return (new JsonResponse())->respondForbidden(trans('tasks::responses.msg_by_code.403'));
            }
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $this->repository->pushCriteria(app('Modules\Tasks\Criteria\TasksStatusesCriteria'));
        $tasksStatuses = $this->repository->with(['tasks', 'tasks.assignedUsers', 'tasks.comments', 'creator', 'editor', 'owner'])->all();

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasksStatuses,
            ]);
        }

        return view('tasks::statuses.index', compact('tasksStatuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TasksStatuseCreateRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TasksStatuseCreateRequest $request)
    {
        try {
            $validated = $request->only(['name', 'position', 'color', 'is_closed', 'default', 'company_id', 'space_id', 'created_by']);

            $tasksStatuse = $this->repository->create($validated);

            $response = [
                'message' => 'TasksStatuse created.',
                'data' => $tasksStatuse,
            ];

            if ($request->expectsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

//            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $isAuthorized = Auth::user()->ability(['Super Admin', 'manger'], ['read_tasks_statuse'])
            || Auth::user()->isEmployeeManger()
            || in_array($id, Auth::user()->allUserWorkspacesIds());

        if (! $isAuthorized) {
            if ($request->expectsJson()) {
                return (new JsonResponse())->respondForbidden(trans('tasks::responses.msg_by_code.403'));
            }
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $tasksStatuse = $this->repository->find($id);
        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasksStatuse,
            ]);
        }

        return view('tasks::statuses.show', compact('tasksStatuse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasksStatuse = $this->repository->find($id);

        return view('tasksStatuses.edit', compact('tasksStatuse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TasksStatuseUpdateRequest  $request
     * @param  string  $id
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TasksStatuseUpdateRequest $request, $id)
    {
        try {
            $tasksStatuse = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TasksStatuse updated.',
                'data' => $tasksStatuse,
            ];

            if ($request->expectsJson()) {
                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'error' => true,
                    'message' => $e->getMessageBag(),
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TO DO , verify that ,the user has permission to this statuse workspace
        $taskStatuse = $this->repository->whereId($id)->first();

        $isAuthorized = Auth::user()->ability(['Super Admin', 'manger'], ['delete_tasks_statuse'])
            || Auth::user()->isEmployeeManger() || $taskStatuse->created_by == Auth::user()->id;

        if (! $isAuthorized) {
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $deleted = $this->repository->delete($id);

        // TO DO make it optional to delete related tasks
//        $this->repository->deleteRelatedTasks($id);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'TasksStatuse deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TasksStatuse deleted.');
    }
}
