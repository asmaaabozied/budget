<?php

namespace Modules\Tasks\Repositories;

use Modules\Tasks\Entities\Task;
use Modules\Tasks\Entities\TasksStatuse;
use Modules\Tasks\Events\TaskMediaUpdated;
use Modules\Tasks\Events\TaskStatusUpdated;
use Modules\Tasks\Interfaces\TasksRepository;
use Modules\Tasks\Presenters\TaskPresenter;
use Modules\Tasks\Traits\Historyable;
use Modules\Tasks\Validators\TaskValidator;
use Panoscape\History\Events\ModelChanged;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TaskRepositoryEloquent.
 */
class TasksRepositoryEloquent extends BaseRepository implements TasksRepository
{
    use Historyable;

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Task::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return TaskValidator::class;
    }

    public function presenter()
    {
        return TaskPresenter::class;
    }

    public function reorderTasks($tasks)
    {
        foreach ($tasks as $task) {
            $task = $this->update(
                ['order' => $task['order'],
                    'status_id' => $task['status_id'], ],
                $task['id']);

            $updatedTask = $this->whereId($task['data']['id'])->with(['status', 'statusesHistories'])->first();
            $this->updateTaskStatuseHistory($updatedTask);
        }
    }

    public function syncAssignedUsers(Task $task, $attributes)
    {
        // get old assignedUsers ids before detach and attach new value
        $oldUsers = $task->assignedUsers->pluck('id')->toArray();

        $users = isset($attributes['assign_all']) ?
            $task->workspace->users->pluck('id')
            : ($attributes['users'] ? $attributes['users'] : null);

        // sync task users
        if (isset($users) && is_array($users) && ($users != $oldUsers)) {
            $task->assignedUsers()->sync($users);

            // make sure refresh relation after attach new assigned users
            $task->refresh();

            // get new assignedUsers ids after attach new value
            $newUsers = $task->assignedUsers->pluck('id')->toArray();
            $changedAssignedUsers = $this->getChangedRelationAsObject($oldUsers, $newUsers, 'assignedUsers');
            //fire a model changed event
            event(new ModelChanged($task, 'assigned_users_updated', $changedAssignedUsers));
        }
    }

    public function updateTaskStatuseHistory(Task $task, $fireNotification = true)
    {
        $taskLastHistory = ! is_null($task->statusesHistories) ? $task->statusesHistories->first() : null; // last history
        // do not duplicate status histories
        if (! isset($taskLastHistory) || ($taskLastHistory->tasks_statuses_id != $task->status_id)) {
            $oldStatus = $taskLastHistory ? TasksStatuse::where('id', $taskLastHistory->tasks_statuses_id)->select('name')->firstOrFail() : ''; // used in notifications
                $notified_users = $task->assignedUsers->pluck('id')->toArray(); // must be array

                // for Reserve , we will get every thing in histories
            event(new TaskStatusUpdated($task->unsetRelations(), $notified_users, $oldStatus->name ?? '', $task->status->name, $fireNotification));
        }
    }

    public function attachTaskMedaiHistory(Task $task, $transKey = 'medai_added', $fireNotification = true)
    {
        $task->refresh();
        $oldMedai = []; // no old value
        // get new assignedUsers ids after attach new value
        $newMedai = $task->media()->pluck('id')->toArray();
        $createdMedai = $this->getChangedRelationAsObject($oldMedai, $newMedai, 'medai');
        $notified_users = $task->assignedUsers->pluck('id')->toArray();
        //fire a model changed event
        event(new ModelChanged($task, $transKey, $createdMedai));
        event(new TaskMediaUpdated($task->unsetRelations(), $notified_users, '', '', $fireNotification));
    }

    public function deleteRelatedTasks($id)
    {
        $status = $this->find($id);
        $status->tasks()->delete();
    }

    public function findBySlug($slug)
    {
        return $this->model->where('slug',$slug)->first();
    }
}
