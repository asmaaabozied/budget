<?php

namespace Modules\Tasks\Presenters;

use Modules\Tasks\Transformers\TasksCommentTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TasksCommentPresenter.
 */
class TasksCommentPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TasksCommentTransformer();
    }
}
