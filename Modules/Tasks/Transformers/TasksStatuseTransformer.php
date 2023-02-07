<?php

namespace Modules\Tasks\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Tasks\Entities\TasksStatuse;

/**
 * Class TasksStatuseTransformer.
 */
class TasksStatuseTransformer extends TransformerAbstract
{
    /**
     * Transform the TasksStatuse entity.
     *
     * @param  \Modules\Tasks\Entities\TasksStatuse  $model
     * @return array
     */
    public function transform(TasksStatuse $model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'position' => $model->position,
            'color' => $model->color,
            'is_closed' => $model->is_closed,
            'default' => $model->default,
            'company_id' => $model->company_id,
            'tasks_count' => $model->tasks_count,
            'tasks' => $model->tasks,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
