<?php

namespace Modules\Cms\src\LinkManager\Traits;

use Modules\Cms\src\LinkManager\CmsLinkObserver;

trait HasLinks
{
    public static function bootHasLinks()
    {
        static::observe(CmsLinkObserver::class);
    }
}
