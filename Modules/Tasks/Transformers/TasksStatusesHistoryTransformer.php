<?php

namespace Modules\Tasks\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Tasks\Entities\TasksStatusesHistory;

/**
 * Class TasksStatusesHistoryTransformer.
 */
class TasksStatusesHistoryTransformer extends TransformerAbstract
{
    /**
     * Transform the TasksStatusesHistory entity.
     *
     * @param  \Modules\Tasks\Entities\TasksStatusesHistory  $model
     * @return array
     */
    public function transform(TasksStatusesHistory $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
