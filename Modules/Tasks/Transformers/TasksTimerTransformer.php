<?php

namespace Modules\Tasks\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Tasks\Entities\TasksTimer;

/**
 * Class TasksTimerTransformer.
 */
class TasksTimerTransformer extends TransformerAbstract
{
    /**
     * Transform the TasksTimer entity.
     *
     * @param  \Modules\Tasks\Entities\TasksTimer  $model
     * @return array
     */
    public function transform(TasksTimer $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
