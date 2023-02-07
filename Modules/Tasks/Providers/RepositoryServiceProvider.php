<?php

namespace Modules\Tasks\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                'Modules\Tasks\Interfaces\TasksRepository',
                'Modules\Tasks\Repositories\TasksRepositoryEloquent'
            );
        $this->app->bind(
            'Modules\Tasks\Interfaces\TasksCommentRepository',
            'Modules\Tasks\Repositories\TasksCommentRepositoryEloquent'
        );
        $this->app->bind(
            'Modules\Tasks\Interfaces\TasksStatuseRepository',
            'Modules\Tasks\Repositories\TasksStatuseRepositoryEloquent'
        );
        $this->app->bind(
            'Modules\Tasks\Interfaces\TasksStatusesHistoryRepository',
            'Modules\Tasks\Repositories\TasksStatusesHistoryRepositoryEloquent'
        );
        $this->app->bind(
            'Modules\Tasks\Interfaces\TasksTimerRepository',
            'Modules\Tasks\Repositories\TasksTimerRepositoryEloquent'
        );
        $this->app->bind(
            'Modules\Tasks\Interfaces\TasksWorkspacesRepository',
            'Modules\Tasks\Repositories\TasksWorkspacesRepositoryEloquent'
        );

        $this->app->bind(
            'Modules\Tasks\Interfaces\WorkspaceLinkRepository',
            'Modules\Tasks\Repositories\WorkspaceLinkRepositoryEloquent'
        );

        $this->app->bind(
            'Modules\Tasks\Interfaces\NotificationRepository',
            'Modules\Tasks\Repositories\NotificationRepositoryEloquent'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
