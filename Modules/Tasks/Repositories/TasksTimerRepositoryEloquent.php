<?php

namespace Modules\Tasks\Repositories;

use Modules\Tasks\Entities\TasksTimer;
use Modules\Tasks\Interfaces\TasksTimerRepository;
use Modules\Tasks\Presenters\TasksTimerPresenter;
use Modules\Tasks\Validators\TasksTimerValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TasksTimerRepositoryEloquent.
 */
class TasksTimerRepositoryEloquent extends BaseRepository implements TasksTimerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TasksTimer::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return TasksTimerValidator::class;
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
        return TasksTimerPresenter::class;
    }
}
