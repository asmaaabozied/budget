<?php

namespace Modules\Tasks\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Tasks\Events\TaskAdded;
use Modules\Tasks\Events\TaskCommentAdded;
use Modules\Tasks\Events\TaskMediaUpdated;
use Modules\Tasks\Events\TaskStatusUpdated;
use Modules\Tasks\Events\TaskUpdated;
use Modules\Tasks\Listeners\NotifyTaskAdded;
use Modules\Tasks\Listeners\NotifyTaskCommentAdded;
use Modules\Tasks\Listeners\NotifyTaskMediaUpdated;
use Modules\Tasks\Listeners\NotifyTaskStatusUpdated;
use Modules\Tasks\Listeners\NotifyTaskUpdated;
use Modules\Tasks\Listeners\UpdateTaskStatusHistory;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    protected $listen = [
        TaskStatusUpdated::class => [
            UpdateTaskStatusHistory::class,
            NotifyTaskStatusUpdated::class,
        ],
        TaskCommentAdded::class => [
            NotifyTaskCommentAdded::class,
        ],
        TaskMediaUpdated::class => [
            NotifyTaskMediaUpdated::class,
        ],
        TaskUpdated::class => [
            NotifyTaskUpdated::class,
        ],
        TaskAdded::class => [
            NotifyTaskAdded::class,
        ],
    ];
}
