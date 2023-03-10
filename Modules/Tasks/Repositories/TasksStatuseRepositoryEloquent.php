<?php

namespace Modules\Tasks\Repositories;

use Modules\Tasks\Entities\TasksStatuse;
use Modules\Tasks\Interfaces\TasksStatuseRepository;
use Modules\Tasks\Presenters\TasksStatusePresenter;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TasksStatuseRepositoryEloquent.
 */
class TasksStatuseRepositoryEloquent extends BaseRepository implements TasksStatuseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TasksStatuse::class;
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
        return TasksStatusePresenter::class;
    }
}
