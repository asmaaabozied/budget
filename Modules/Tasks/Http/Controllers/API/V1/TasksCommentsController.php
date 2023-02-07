<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use function app;
use App\Http\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Criteria\TaskCommentsCriteria;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Http\Controllers\Response;
use Modules\Tasks\Http\Requests\TasksCommentCreateRequest;
use Modules\Tasks\Http\Requests\TasksCommentUpdateRequest;
use Modules\Tasks\Interfaces\TasksCommentRepository;
use Modules\Tasks\Interfaces\TasksRepository;
use  Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use function redirect;
use function request;
use function response;
use function view;

/**
 * Class TasksCommentsController.
 */
class TasksCommentsController extends Controller
{
    /**
     * @var TasksCommentRepository
     */
    protected $repository;

    protected $taskRepository;

    /**
     * TasksCommentsController constructor.
     *
     * @param  TasksCommentRepository  $repository
     */
    public function __construct(TasksCommentRepository $repository, TasksRepository $taskRepository)
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
        $this->repository->pushCriteria(app(TaskCommentsCriteria::class));
        $tasksComments = $this->repository->all();

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasksComments,
            ]);
        }

        return view('tasks::comments.index', compact('tasksComments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TasksCommentCreateRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TasksCommentCreateRequest $request)
    {
        try {
            $validated = $request->only(['content', 'task_id', 'user_id', 'parent_id']);
            $tasksComment = $this->repository->create($validated);
            $comment = $this->repository->whereId($tasksComment['data']['id'])->with(['user', 'replies', 'replies.user', 'parent', 'task'])->first();
            $comment->refresh();

            $this->repository->addCommentHistory($comment, $comment->task);

            $response = [
                'message' => 'Task Comment created.',
                'data' => $comment,
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasksComment = $this->repository->find($id);
        $isAuthorized = Auth::user()->ability(['Super Admin', 'manger'], ['read_tasks_comments'])
            || Auth::user()->isEmployeeManger()
            || in_array($tasksComment->task_id, Auth::user()->allUserTasksIdsAsArray());

        if (! $isAuthorized) {
            if (request()->expectsJson()) {
                return (new JsonResponse())->respondForbidden(trans('tasks::responses.msg_by_code.403'));
            }
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasksComment,
            ]);
        }

        return view('tasks::comments.show', compact('tasksComment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasksComment = $this->repository->find($id);

        return view('tasksComments.edit', compact('tasksComment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TasksCommentUpdateRequest  $request
     * @param  string  $id
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TasksCommentUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tasksComment = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TasksComment updated.',
                'data' => $tasksComment->toArray(),
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
        $tasksComment = $this->repository->find($id);
        $isAuthorized = Auth::user()->ability(['Super Admin', 'manger'], ['delete_tasks_comments'])
            || Auth::user()->isEmployeeManger()
            || in_array($tasksComment->task_id, Auth::user()->allUserTasksIdsAsArray());

        if (! $isAuthorized) {
            if (request()->expectsJson()) {
                return (new JsonResponse())->respondForbidden(trans('tasks::responses.msg_by_code.403'));
            }
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $deleted = $this->repository->delete($id);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'TasksComment deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TasksComment deleted.');
    }
}
