<?php

namespace Modules\Tasks\Listeners;

use App\User;
use Modules\Tasks\Events\TaskStatusUpdated;
use Modules\Tasks\Notifications\TaskUpdatesNotification;

class NotifyTaskStatusUpdated
{
    // TO DO , Implement should queue , after upgrade server

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
     * @param  TaskStatusUpdated  $event
     * @return void
     */
    public function handle(TaskStatusUpdated $event)
    {
        if ($event->fireNotification) {
            // to ensure every item return User class instance
            User::whereIn('id', $event->users)->get()
                ->each(function ($user) use ($event) {
                    $user->notify(new TaskUpdatesNotification($event->task, 'status_updated',
                        'status_updated', $event->oldStatus, $event->newStatus));
                });
        }
    }
}
