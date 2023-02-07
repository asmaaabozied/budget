<?php

namespace Modules\Tasks\Listeners;

use Illuminate\Support\Facades\Auth;
use Modules\Tasks\Entities\TasksStatusesHistory;
use Modules\Tasks\Events\TaskStatusUpdated;

class UpdateTaskStatusHistory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(TaskStatusUpdated $event)
    {
        TasksStatusesHistory::create([
            'task_id' => $event->task->id,
            'tasks_statuses_id' => $event->task->status_id,
            'created_by' => Auth::id() ?: $event->task->edited_by,
        ]);
    }
}
