<?php

namespace Modules\Tasks\Presenters;

use Modules\Tasks\Transformers\TasksTimerTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TasksTimerPresenter.
 */
class TasksTimerPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TasksTimerTransformer();
    }
}
