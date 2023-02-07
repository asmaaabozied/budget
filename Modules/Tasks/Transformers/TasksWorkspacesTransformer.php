<?php

namespace Modules\Tasks\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Tasks\Entities\TasksWorkspace;

/**
 * Class TasksWorkspacesTransformer.
 */
class TasksWorkspacesTransformer extends TransformerAbstract
{
    // https://fractal.thephpleague.com/transformers/

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
    ];

    /**
     * Transform the TasksWorkspaces entity.
     *
     * @param  \Modules\Tasks\Entities\TasksWorkspace  $model
     * @return array
     */
    public function transform(TasksWorkspace $workspace)
    {
        return [
            'id' => (int) $workspace->id,
            'name' => $workspace->name,
            'description' => $workspace->description,
            'statuses' => $workspace->statuses,
            'statuses_count' => $workspace->statuses->count(),
            'all_tasks_count' => $workspace->allTasks->count(),
            'tasks_pool_count' => $workspace->tasksPool->count(),
            'all_users_count' => $workspace->users->count(),
            // not used yet
            //            'company'       => $workspace->company(),
            //            'branch'        => $workspace->branch(),
            //            'tasksPool'     => $workspace->tasksPool(),
            //            'creator'       => $workspace->creator(),
            //            'editor'        => $workspace->editor(),
            'users' => $workspace->users,
            'links' => $workspace->links,
            'created_at' => $workspace->created_at,
            'updated_at' => $workspace->updated_at,
            'notifications' => auth()->user()->unreadNotifications()->whereJsonContains('data', ['space_id' => $workspace->id])->get(),
            'notifications_count' => auth()->user()->unreadNotifications()->whereJsonContains('data', ['space_id' => $workspace->id])->count(),
        ];
    }
}
