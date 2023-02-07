<?php

namespace Modules\Tasks\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Tasks\Entities\TasksComment;

/**
 * Class TasksCommentTransformer.
 */
class TasksCommentTransformer extends TransformerAbstract
{
    /**
     * Transform the TasksComment entity.
     *
     * @param  \Modules\Tasks\Entities\TasksComment  $model
     * @return array
     */
    public function transform(TasksComment $model)
    {
        return [
            'id' => (int) $model->id,
            'content' => $model->content,
            'parent_id' => $model->parent_id,
            'parent' => $model->parent,
            'user_id' => $model->user_id,
            'task_id' => $model->task_id,
            'replies' => $model->replies,
            'replies_count' => $model->replies->count(),
            'user' => $model->user,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
