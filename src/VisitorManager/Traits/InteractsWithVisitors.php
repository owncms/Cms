<?php

namespace Modules\Cms\src\VisitorManager\Traits;

use Illuminate\Http\Request;
use Modules\Cms\src\VisitorManager\VisitorManager;
use Modules\Cms\src\VisitorManager\VisitorStatisticManager;

trait InteractsWithVisitors
{
    public function withVisitorManager($model, Request $request)
    {
        return new VisitorManager($model, $request);
    }

    public function withVisitorStatisticManager($model, Request $request)
    {
        return new VisitorStatisticManager($model, $request);
    }
}
