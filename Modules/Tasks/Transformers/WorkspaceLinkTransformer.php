<?php

namespace Modules\Tasks\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Tasks\Entities\WorkspaceLink;

/**
 * Class WorkspaceLinkTransformer.
 */
class WorkspaceLinkTransformer extends TransformerAbstract
{
    /**
     * Transform the WorkspaceLink entity.
     *
     * @param  \App\Entities\WorkspaceLink  $model
     * @return array
     */
    public function transform(WorkspaceLink $model)
    {
        return [
            'id' => (int) $model->id,
            'name' => $model->name,
            'link' => $model->link,
            'icon' => $model->icon,
            'icon_color' => $model->icon_color,
            'space_id' => $model->space_id,
            'parent_id' => $model->parent_id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
