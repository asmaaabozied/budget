<?php

namespace Modules\Tasks\Presenters;

use Modules\Tasks\Transformers\TasksStatuseTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TasksStatusePresenter.
 */
class TasksStatusePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TasksStatuseTransformer();
    }
}
