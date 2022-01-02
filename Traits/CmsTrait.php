<?php

namespace Modules\Cms\Traits;
use Modules\LinkGenerator\Services\LinkGenerator;

trait CmsTrait
{
    public static function bootListeners()
    {
//        static::created(function ($item) {
//            (new LinkGenerator($item))->store();
//        });
    }
}
