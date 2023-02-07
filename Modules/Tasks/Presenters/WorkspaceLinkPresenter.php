<?php

namespace Modules\Tasks\Presenters;

use Modules\Tasks\Transformers\WorkspaceLinkTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class WorkspaceLinkPresenter.
 */
class WorkspaceLinkPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new WorkspaceLinkTransformer();
    }
}
