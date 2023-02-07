<?php

namespace Modules\Tasks\Presenters;

use Modules\Tasks\Transformers\TasksStatusesHistoryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TasksStatusesHistoryPresenter.
 */
class TasksStatusesHistoryPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TasksStatusesHistoryTransformer();
    }
}
