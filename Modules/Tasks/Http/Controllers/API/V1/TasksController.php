<?php

namespace Modules\Tasks\Http\Controllers\API\V1;

use function app;
use App\Http\Responses\JsonResponse;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Modules\Tasks\Events\TaskAdded;
use Modules\Tasks\Events\TaskUpdated;
use Modules\Tasks\Http\Controllers\Controller;
use Modules\Tasks\Http\Controllers\Response;
use Modules\Tasks\Http\Requests\TaskCreateRequest;
use Modules\Tasks\Http\Requests\TaskUpdateRequest;
use Modules\Tasks\Interfaces\TasksRepository;
use Panoscape\History\Events\ModelChanged;
use Prettus\Validator\Exceptions\ValidatorException;
use RahulHaque\Filepond\Facades\Filepond;
use RahulHaque\Filepond\Services\FilepondService;
use function redirect;
use function request;
use function response;
use function view;

/**
 * Class TasksController.
 */
class TasksController extends Controller
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
    public function index(Request $request)
    {
        $this->repository->pushCriteria(app('Modules\Tasks\Criteria\TasksCriteria'));
        $tasks = $this->repository->with(['comments', 'assignedUsers']);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $tasks,
            ]);
        }

        return view('tasks::index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskCreateRequest  $request
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TaskCreateRequest $request, FilepondService $service)
    {
        try {
            $validated = $request->only(['name', 'description', 'expected_time', 'priority', 'order',
                'progress', 'status_id', 'space_id', 'company_id', 'parent_id', 'branch_id', 'expiry_time', 'slug', 'created_by', 'owner_id' ]);

            $relations = ['statusesHistories', 'creator', 'status', 'comments', 'assignedUsers', 'media'];

            $task = $this->repository->create($validated);
            $InsertedTask = $this->repository->whereId($task['data']['id'])->with($relations)->first();
            if ($request->assign_all || $request->users) {
                $this->repository->syncAssignedUsers($InsertedTask, $request->all());
            }

            if ($InsertedTask->assignedUsers) {
                // for notifications, not related to task history
                $notified_users = $InsertedTask->assignedUsers->pluck('id')->toArray();
                event(new TaskAdded($InsertedTask->unsetRelations(), $notified_users, '', ''));
            }

            $this->repository->updateTaskStatuseHistory($InsertedTask, false);
            $medaicounter = 0;

            foreach ($request->attachments as $val) {
                if (! is_null($val['serverId'])) {
                    // to avoid invalid payload error , we will not process null serverId

                    $input = Crypt::decrypt($val['serverId']);
                    $fileRow = Auth::user()->fileponds->where('id', $input['id'])->first();

                    $fileName = date('Y-m-d-H-i-s').'_'.auth()->id(); // unique file name
                    // the follwing line will return file object with all arrtibutes , like that come from request
                    $fileInfo = Filepond::field(Crypt::encrypt($fileRow))->moveTo('tasks_media/'.$fileName);

                    // add files to task using spatie media library
                    $mediaItem = $InsertedTask->addMediaFromDisk($fileInfo['location'], 'public')
                        ->preservingOriginal()
                        ->toMediaCollection('tasks-media');
                    // custom prop for front app
                    $mediaItem->setCustomProperty('full_url', $mediaItem->getFullUrl());
                    $mediaItem->setCustomProperty('human_readable_size', $mediaItem->human_readable_size);
                    $mediaItem->save();

                    if ($mediaItem) {
                        $medaicounter++;
                    }
                } // close if
            }

            if ($medaicounter >= 1) {
                $this->repository->attachTaskMedaiHistory($InsertedTask, 'medai_added', false);
            }

//            event(new ModelChanged($InsertedTask, 'tasks::model_history.task.assigned_users_updated' ));

            // to avoid missing relations because unsetRelations in events
            $InsertedTask->load($relations);

            $response = [
                'message' => 'Task created.',
                'data' => $InsertedTask,
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
        $task = $this->repository->whereId($id)->first();

        $isAuthorized = Auth::user()->ability(['Super Admin', 'manger'], ['read_task'])
            || Auth::user()->isEmployeeManger()
            || in_array($id, Auth::user()->allUserTasksIdsAsArray())
            || in_array($task->space_id, Auth::user()->allUserWorkspacesIdsAsArray());

        if (! $isAuthorized) {
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $task = $this->repository->with(['comments', 'comments.user', 'status', 'comments.replies', 'comments.replies.user', 'comments.parent', 'assignedUsers', 'media', 'histories'])->find($id);

        if (request()->expectsJson()) {
            return response()->json([
                'data' => $task,
            ]);
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = $this->repository->find($id);

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskUpdateRequest  $request
     * @param  string  $id
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        try {
            $validated = $request->only(['name', 'description', 'expected_time', 'priority', 'order',
                'progress', 'status_id', 'space_id', 'company_id', 'parent_id', 'branch_id', 'expiry_time', 'slug', 'edited_by', ]);

            $relations = ['statusesHistories', 'creator', 'status', 'comments', 'assignedUsers', 'media'];

            $task = $this->repository->update($validated, $id);
            $updatedTask = $this->repository->whereId($task['data']['id'])->with($relations)->first();
            if ($request->assign_all || $request->users) {
                $assignedUsers = $this->repository->syncAssignedUsers($updatedTask, $request->all());
            }

            if ($updatedTask->assignedUsers) {
                // for notifications, not related to task history
                $notified_users = $updatedTask->assignedUsers->pluck('id')->toArray();
                // unsetRelations() is important to avoid exceed limit size of data for pusher
                broadcast(new TaskUpdated($updatedTask->unsetRelations(), $notified_users, '', ''));
            }

            $this->repository->updateTaskStatuseHistory($updatedTask);

            $medaicounter = 0;

            // delete all previouse media and add new
            $updatedTask->clearMediaCollection('tasks-media');

            foreach ($request->attachments as $val) {
                if (! is_null($val['serverId'])) {
                    // to avoid invalid payload error , we will not process null serverId

                    $input = Crypt::decrypt($val['serverId']);
                    $fileRow = Auth::user()->fileponds->where('id', $input['id'])->first();

                    $fileName = date('Y-m-d-H-i-s').'_'.auth()->id(); // unique file name
                    // the follwing line will return file object with all arrtibutes , like that come from request
                    $fileInfo = Filepond::field(Crypt::encrypt($fileRow))->moveTo('tasks_media/'.$fileName);

                    // add files to task using spatie media library
                    $mediaItem = $updatedTask->addMediaFromDisk($fileInfo['location'], 'public')
                        ->preservingOriginal()
                        ->toMediaCollection('tasks-media');

                    // custom prop for front app
                    $mediaItem->setCustomProperty('full_url', $mediaItem->getFullUrl());
                    $mediaItem->setCustomProperty('human_readable_size', $mediaItem->human_readable_size);
                    $mediaItem->save();

                    if ($mediaItem) {
                        $medaicounter++;
                    }
                }
            }

            $updatedTask->refresh();

            if ($medaicounter >= 1) {
                $this->repository->attachTaskMedaiHistory($updatedTask, 'medai_updated');
            }
            $response = [
                'message' => 'Task updated.',
                'data' => $updatedTask,
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
        $isAuthorized = Auth::user()->ability(['Super Admin', 'manger'], ['delete_task'])
           || Auth::user()->isEmployeeManger()
           || in_array($id, Auth::user()->ownerTasks->pluck('id')->toArray());

        if (! $isAuthorized) {
            if (request()->expectsJson()) {
                return (new JsonResponse())->respondForbidden(trans('tasks::responses.msg_by_code.403'));
            }
            abort(403, trans('tasks::responses.msg_by_code.403'));
        }

        $deleted = $this->repository->delete($id);

        if (request()->expectsJson()) {
            return response()->json([
                'message' => 'Task deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Task deleted.');
    }
}
