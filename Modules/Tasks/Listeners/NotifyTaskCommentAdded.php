<?php

namespace Modules\Tasks\Listeners;

use App\User;
use Modules\Tasks\Events\TaskCommentAdded;
use Modules\Tasks\Events\TaskMediaUpdated;
use Modules\Tasks\Notifications\TaskUpdatesNotification;

class NotifyTaskCommentAdded
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
     * @param  TaskMediaUpdated  $event
     * @return void
     */
    public function handle(TaskCommentAdded $event)
    {
        if ($event->fireNotification) {
            // to ensure every item return User class instance
            User::whereIn('id', $event->users)->get()
                ->each(function ($user) use ($event) {
                    $user->notify(new TaskUpdatesNotification($event->task, 'comment_added',
                        'comment_added', $event->oldStatus, $event->newStatus));
                });
        }
    }
}
