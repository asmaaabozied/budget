<?php

namespace Modules\Tasks\Listeners;

use App\User;
use Modules\Tasks\Events\TaskMediaUpdated;
use Modules\Tasks\Notifications\TaskUpdatesNotification;

class NotifyTaskMediaUpdated
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
    public function handle(TaskMediaUpdated $event)
    {
        if ($event->fireNotification) {
            // to ensure every item return User class instance
            User::whereIn('id', $event->users)->get()
                ->each(function ($user) use ($event) {
                    $user->notify(new TaskUpdatesNotification($event->task, 'medai_updated',
                        'medai_updated', $event->oldStatus, $event->newStatus));
                });
        }
    }
}
