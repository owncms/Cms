<?php

namespace Modules\Cms\src\LinkManager;

use Illuminate\Database\Eloquent\Model;

class CmsLinkObserver
{
    public function saved(Model $model)
    {
        dd($model);
    }
}
