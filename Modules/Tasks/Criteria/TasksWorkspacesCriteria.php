<?php

namespace Modules\Tasks\Criteria;

use App\Criteria\BaseRequestCriteria;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TasksWorkspacesCriteria.
 */
class TasksWorkspacesCriteria extends BaseRequestCriteria
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
        $isAuthorizedToShowAll = Auth::user()->ability(['Super Admin', 'manager'], ['viewAny_tasks_workspace']);
        // just show allowed workspaces for user , that assigned to him or his own workspaces
        if (! $isAuthorizedToShowAll) {
            return $model->whereIn('id', Auth::user()->allUserWorkspacesIdsAsArray());
        }

        return $model;
    }
}
