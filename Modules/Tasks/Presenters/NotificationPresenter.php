<?php

namespace Modules\Tasks\Presenters;

use Modules\Tasks\Transformers\NotificationTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NotificationPresenter.
 */
class NotificationPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NotificationTransformer();
    }
}
