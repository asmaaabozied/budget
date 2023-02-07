<?php

namespace Modules\Tasks\Presenters;

use Modules\Tasks\Transformers\TaskTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TaskPresenter.
 */
class TaskPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TaskTransformer();
    }
}
