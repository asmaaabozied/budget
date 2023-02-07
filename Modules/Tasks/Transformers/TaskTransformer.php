<?php

namespace Modules\Tasks\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Tasks\Entities\Task;

/**
 * Class TaskTransformer.
 */
class TaskTransformer extends TransformerAbstract
{
    /**
     * Transform the Task entity.
     *
     * @param  \Modules\Tasks\Entities\Task  $model
     * @return array
     */
    public function transform(Task $model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'description' => $model->description,
            'space_id' => $model->space_id,
            'status_id' => $model->status_id,
            'expected_time' => $model->expected_time,
            'total_time' => $model->total_time,
            'priority' => $model->priority,
            'order' => $model->order,
            'progress' => $model->progress,
            'expiry_time' => $model->expiry_time,
            'slug' => $model->slug,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            'assignedUsers' => $model->assignedUsers,
            'comments' => $model->comments,
            'comments_count' => $model->comments->count(),
            'media' => $model->media,
            'mediaFullUrls' => $model->mediaFullUrls,
            'formattedHistories' => $model->formattedHistories(),
            'creator' => $model->creator,
            'editor' => $model->editor,
        ];
    }
}
