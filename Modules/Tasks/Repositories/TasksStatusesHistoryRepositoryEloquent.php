<?php

namespace Modules\Tasks\Repositories;

use Modules\Tasks\Entities\TasksStatusesHistory;
use Modules\Tasks\Interfaces\TasksStatusesHistoryRepository;
use Modules\Tasks\Presenters\TasksStatusesHistoryPresenter;
use Modules\Tasks\Validators\TasksStatusesHistoryValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class TasksStatusesHistoryRepositoryEloquent.
 */
class TasksStatusesHistoryRepositoryEloquent extends BaseRepository implements TasksStatusesHistoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TasksStatusesHistory::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return TasksStatusesHistoryValidator::class;
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
        return TasksStatusesHistoryPresenter::class;
    }
}
