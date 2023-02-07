<?php

namespace Modules\Tasks\Criteria;

use App\Criteria\BaseRequestCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class WorkSpaceLinksCriteria.
 */
class WorkSpaceLinksCriteria extends BaseRequestCriteria
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
        return  $model->where('space_id', '=', $request->space_id);
    }
}
