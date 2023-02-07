<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use function app;
use App\Http\Requests\TasksStatusesHistoryCreateRequest;
use App\Http\Requests\TasksStatusesHistoryUpdateRequest;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Http\Controllers\Response;
use Modules\Tasks\Interfaces\TasksStatusesHistoryRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use function redirect;
use function request;
use function response;
use function view;

/**
 * Class TasksStatusesHistoriesController.
 */
class TasksStatusesHistoriesController extends Controller
{
    /**
     * @var TasksStatusesHistoryRepository
     */
    protected $repository;

    /**
     * TasksStatusesHistoriesController constructor.
     *
     * @param  TasksStatusesHistoryRepository  $repository
     * @param  TasksStatusesHistoryValidator  $validator
     */
    public function __construct(TasksStatusesHistoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app(\App\Criteria\BaseRequestCriteria::class));
        $tasksStatusesHistories = $this->repository->all();

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasksStatusesHistories,
            ]);
        }

        return view('tasks::statuses_histories.index', compact('tasksStatusesHistories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TasksStatusesHistoryCreateRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TasksStatusesHistoryCreateRequest $request)
    {
        try {
            $validated = $request->only(['task_id', 'tasks_statuses_id', 'created_by']);
            $tasksStatusesHistory = $this->repository->create($validated);

            $response = [
                'message' => 'TasksStatusesHistory created.',
                'data' => $tasksStatusesHistory->toArray(),
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
        $tasksStatusesHistory = $this->repository->find($id);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasksStatusesHistory,
            ]);
        }

        return view('tasksStatusesHistories.show', compact('tasksStatusesHistory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasksStatusesHistory = $this->repository->find($id);

        return view('tasks::statuses_histories.edit', compact('tasksStatusesHistory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TasksStatusesHistoryUpdateRequest  $request
     * @param  string  $id
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TasksStatusesHistoryUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tasksStatusesHistory = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TasksStatusesHistory updated.',
                'data' => $tasksStatusesHistory->toArray(),
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
        $deleted = $this->repository->delete($id);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'TasksStatusesHistory deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TasksStatusesHistory deleted.');
    }
}
