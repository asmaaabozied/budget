<?php

namespace Modules\Tasks\Repositories;

use Modules\Tasks\Entities\TasksWorkspace;
use Modules\Tasks\Interfaces\TasksWorkspacesRepository;
use Modules\Tasks\Presenters\TasksWorkspacesPresenter;
use Modules\Tasks\Validators\TasksWorkspacesValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TasksWorkspacesRepositoryEloquent.
 */
class TasksWorkspacesRepositoryEloquent extends BaseRepository implements TasksWorkspacesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TasksWorkspace::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return TasksWorkspacesValidator::class;
    }

    public function syncAssignedUsers(TasksWorkspace $workspace, $attributes)
    {
        $users = isset($attributes['assign_all']) ?
            $workspace->company->users->pluck('id')
            : ($attributes['users'] ? $attributes['users'] : null);

        if (isset($users) && is_array($users)) {
            $workspace->users()->sync($users);
        }
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return TasksWorkspacesPresenter::class;
    }
}
