<?php

namespace Modules\Tasks\Criteria;

use App\Criteria\BaseRequestCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TasksStatusesCriteria.
 */
class TasksStatusesCriteria extends BaseRequestCriteria
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
        // just show statuses related to specefic workspace
        // and user has been assigned to these workspaces or he has it

        return $model->where('space_id', $this->request->get('workspace_id'));
    }
}
