<?php

namespace Modules\Cms\App\src\VisitorManager\Traits;

use Illuminate\Http\Request;
use Modules\Cms\App\src\VisitorManager\VisitorManager;
use Modules\Cms\App\src\VisitorManager\VisitorStatisticManager;

trait InteractsWithVisitors
{
    /**
     * @param $model
     * @param Request $request
     * @return VisitorManager
     */
    public function withVisitorManager($model, Request $request)
    {
        return new VisitorManager($model, $request);
    }

    /**
     * @param $model
     * @param Request $request
     * @return VisitorStatisticManager
     */
    public function withVisitorStatisticManager($model, Request $request)
    {
        return new VisitorStatisticManager($model, $request);
    }
}
