<?php

namespace Modules\Tasks\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Tasks\Entities\Task;

class TaskAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;

    public $users;

    public $oldStatus;

    public $newStatus;

    public $fireNotification = true;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Task $task, array $users = [], $oldStatus = '', $newStatus = '', $fireNotification = true)
    {
        $this->task = $task;
        $this->users = $users;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->fireNotification = $fireNotification;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [new PrivateChannel('workspace-tasks')];
    }
}
