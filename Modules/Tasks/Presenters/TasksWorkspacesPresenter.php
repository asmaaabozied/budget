<?php

namespace Modules\Tasks\Presenters;

use Modules\Tasks\Transformers\TasksWorkspacesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TasksWorkspacesPresenter.
 */
class TasksWorkspacesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TasksWorkspacesTransformer();
    }
}
