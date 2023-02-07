<?php

namespace Modules\Tasks\Repositories;

use Modules\Tasks\Entities\WorkspaceLink;
use Modules\Tasks\Interfaces\WorkspaceLinkRepository;
use Modules\Tasks\Presenters\WorkspaceLinkPresenter;
use Modules\Tasks\Validators\WorkspaceLinkValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class WorkspaceLinkRepositoryEloquent.
 */
class WorkspaceLinkRepositoryEloquent extends BaseRepository implements WorkspaceLinkRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return WorkspaceLink::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {
        return WorkspaceLinkValidator::class;
    }

    public function presenter()
    {
        return WorkspaceLinkPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
