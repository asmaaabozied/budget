<?php

namespace Modules\Tasks\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Tasks\Entities\Notification;

/**
 * Class NotificationTransformer.
 */
class NotificationTransformer extends TransformerAbstract
{
    /**
     * Transform the Notification entity.
     *
     * @param  \Modules\Tasks\Entities\Notification  $model
     * @return array
     */
    public function transform(Notification $model)
    {
        return [
            'id' => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }
}
