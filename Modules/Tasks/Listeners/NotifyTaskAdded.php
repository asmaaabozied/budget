<?php

namespace Modules\Tasks\Listeners;

use App\User;
use Modules\Tasks\Events\TaskAdded;
use Modules\Tasks\Notifications\TaskUpdatesNotification;

class NotifyTaskAdded
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
     * @param  NotifyTaskUpdated  $event
     * @return void
     */
    public function handle(TaskAdded $event)
    {
        if ($event->fireNotification) {
            // to ensure every item return User class instance
            User::whereIn('id', $event->users)->get()
                ->each(function ($user) use ($event) {
                    $user->notify(new TaskUpdatesNotification($event->task, 'added',
                        'added', $event->oldStatus, $event->newStatus));
                });
        }
    }
}
