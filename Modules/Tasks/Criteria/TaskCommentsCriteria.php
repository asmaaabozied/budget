<?php

namespace Modules\Tasks\Criteria;

use App\Criteria\BaseRequestCriteria;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TaskCommentsCriteria.
 */
class TaskCommentsCriteria extends BaseRequestCriteria
{
    /**
     * Apply criteria in query repository
     *
     * @param  string  $model
     * @param  RepositoryInterface  $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return  $model->where('task_id', '=', request()->task_id)
                ->whereIn('space_id', Auth::user()->allUserWorkspacesIdsAsArray());
    }
}
