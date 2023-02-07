<?php

namespace Modules\Tasks\Criteria;

use App\Criteria\BaseRequestCriteria;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TasksCriteria.
 */
class TasksCriteria extends BaseRequestCriteria
{
    /**
     * Apply criteria in query repository
     *
     * @param  string  $model
     * @param  RepositoryInterface  $repository
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    { // TO DO , Handle admin requests to show all tasks except user own tasks
        $isAuthorizedToShowAll = Auth::user()->ability(['Super Admin', 'manager'], ['read_task'])
         || Auth::user()->isEmployeeManger();
        // just show allowed workspaces for user , that assigned to him or his own workspaces
        if (! $isAuthorizedToShowAll) {
            return $model->whereIn('id', Auth::user()->allUserTasksIdsAsArray());
        }

        return $model;
    }
}
