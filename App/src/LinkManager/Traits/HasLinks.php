<?php

namespace Modules\Cms\App\src\LinkManager\Traits;

use Modules\Cms\App\src\LinkManager\CmsLinkObserver;

trait HasLinks
{
    public static function bootHasLinks()
    {
        static::observe(CmsLinkObserver::class);
    }
}
