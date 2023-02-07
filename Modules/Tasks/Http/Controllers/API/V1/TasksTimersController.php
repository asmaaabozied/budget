<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use function app;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Http\Controllers\Response;
use Modules\Tasks\Http\Requests\TasksTimerCreateRequest;
use Modules\Tasks\Http\Requests\TasksTimerUpdateRequest;
use Modules\Tasks\Interfaces\TasksTimerRepository;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use function redirect;
use function request;
use function response;
use function view;

/**
 * Class TasksTimersController.
 */
class TasksTimersController extends Controller
{
    /**
     * @var TasksTimerRepository
     */
    protected $repository;

    /**
     * TasksTimersController constructor.
     *
     * @param  TasksTimerRepository  $repository
     */
    public function __construct(TasksTimerRepository $repository)
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
        $tasksTimers = $this->repository->all();

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasksTimers,
            ]);
        }

        return view('tasks::timers.index', compact('tasksTimers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TasksTimerCreateRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TasksTimerCreateRequest $request)
    {
        try {
            $validated = $request->only(['task_id', 'user_id', 'started_at', 'stopped_at']);
            $tasksTimer = $this->repository->create($validated);

            $response = [
                'message' => 'TasksTimer created.',
                'data' => $tasksTimer->toArray(),
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
        $tasksTimer = $this->repository->find($id);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasksTimer,
            ]);
        }

        return view('tasks::timers.show', compact('tasksTimer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasksTimer = $this->repository->find($id);

        return view('tasksTimers.edit', compact('tasksTimer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TasksTimerUpdateRequest  $request
     * @param  string  $id
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TasksTimerUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tasksTimer = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'TasksTimer updated.',
                'data' => $tasksTimer->toArray(),
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
                'message' => 'TasksTimer deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'TasksTimer deleted.');
    }
}
