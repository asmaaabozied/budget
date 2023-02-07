<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use function app;
use App\Http\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Http\Controllers\Response;
use Modules\Tasks\Http\Requests\TasksWorkspacesCreateRequest;
use Modules\Tasks\Http\Requests\TasksWorkspacesUpdateRequest;
use Modules\Tasks\Interfaces\TasksWorkspacesRepository;
use Modules\Tasks\Transformers\TasksWorkspacesTransformer;
use Prettus\Validator\Exceptions\ValidatorException;
use function redirect;
use function request;
use function response;
use function view;

/**
 * Class TasksWorkspacesController.
 */
class TasksWorkspacesController extends Controller
{
    /**
     * @var TasksWorkspacesRepository
     */
    protected $repository;

    /**
     * TasksWorkspacesController constructor.
     *
     * @param  TasksWorkspacesRepository  $repository
     * @param  TasksWorkspacesValidator  $validator
     *
     * NOTE: the TasksWorkspacesTransformer will be applied automatically with every query ,, because we use it by default in TasksWorkspacesRepositoryEloquent
     */
    public function __construct(TasksWorkspacesRepository $repository)
    {
        $this->repository = $repository;
    }

    /*
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = intval($request->limit);
        $this->repository->pushCriteria(app('Modules\Tasks\Criteria\TasksWorkspacesCriteria'));
        $tasksWorkspaces = $this->repository
            ->with(['users', 'links', 'tasksPool', 'statuses', 'statuses.tasks',
            'statuses.tasks.assignedUsers',
            'statuses.tasks.comments',
            'statuses.tasks.comments.replies',
            'statuses.tasks.status',
//            'statuses.tasks.creator', // git error Response has been truncated
//            'statuses.tasks.editor', // git error Response has been truncated
            'creator', 'editor'
            ])

//          ->whereHas('statuses', function ($q) {
//                return $q->whereHas('tasks');
//            })
            ->paginate();

        if (request()->expectsJson()) {
            return response()->json($tasksWorkspaces);
        }

        return view('tasks::workspaces.index', compact('tasksWorkspaces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TasksWorkspacesCreateRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TasksWorkspacesCreateRequest $request)
    {
        try {
            $validated = $request->only(['name', 'description', 'company_id', 'branch_id', 'created_by']);
            $tasksWorkspace = $this->repository->create($validated);
            $InsertedTasksWorkspace = $this->repository->whereId($tasksWorkspace['data']['id'])->with(['users'])->first();
            if ($request->assign_all || $request->users) {
                $this->repository->syncAssignedUsers($InsertedTasksWorkspace, $request->only(['assign_all', 'users']));
            }

            $InsertedTasksWorkspace->refresh();

            $response = [
                'message' => 'TasksWorkspaces created.',
                'data' => $InsertedTasksWorkspace,
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

            // return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $isAuthorized = Auth::user()->ability(['Super Admin'], ['read_tasks_workspace'])
            || in_array($id, Auth::user()->allUserWorkspacesIdsAsArray());

        if (! $isAuthorized) {
            if (request()->expectsJson()) {
                return (new JsonResponse())->respondForbidden(trans('tasks::responses.msg_by_code.403'));
            }
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $tasksWorkspace = $this->repository->where('id',$id)
            ->with(['users', 'links', 'tasksPool', 'statuses', 'statuses.tasks',
                'statuses.tasks.assignedUsers',
                'statuses.tasks.comments',
                'statuses.tasks.comments.replies',
                'statuses.tasks.status',
                'statuses.tasks.creator',
                'statuses.tasks.editor',
                'creator', 'editor'
            ])->first();

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasksWorkspace,
            ]);
        }

        return view('tasks::workspaces.show', compact('tasksWorkspace'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasksWorkspace = $this->repository->find($id);

        return view('tasksWorkspaces.edit', compact('tasksWorkspace'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TasksWorkspacesUpdateRequest  $request
     * @param  string  $id
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TasksWorkspacesUpdateRequest $request, $id)
    {
        try {
            $validated = $request->only(['name', 'description', 'company_id', 'branch_id', 'created_by']);
            $tasksWorkspace = $this->repository->update($validated, $id);
            $InsertedTasksWorkspace = $this->repository->whereId($tasksWorkspace['data']['id'])->with(['users'])->first();
            if ($request->assign_all || $request->users) {
                $this->repository->syncAssignedUsers($InsertedTasksWorkspace, $request->only(['assign_all', 'users']));
            }

            $InsertedTasksWorkspace->refresh();

            $response = [
                'message' => 'TasksWorkspaces updated.',
                'data' => $InsertedTasksWorkspace,
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
        $isAuthorized = Auth::user()->ability(['Super Admin'], ['delete_tasks_workspace'])
            || in_array($id, Auth::user()->ownerWorkspaces->pluck('id')->toArray());

        if (! $isAuthorized) {
            if (request()->expectsJson()) {
                return (new JsonResponse())->respondForbidden(trans('tasks::responses.msg_by_code.403'));
            }

            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $deleted = $this->repository->delete($id);
//             to do
//            $deleted->users()->detach();

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'TasksWorkspaces deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TasksWorkspaces deleted.');
    }
}
