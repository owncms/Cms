<?php

namespace Modules\Cms\Entities;

use Modules\Cms\src\LinkManager\CmsLinkObserver;
use Modules\Core\Entities\CoreModel;
use Modules\Admin\Traits\OnlineModel;

class CmsLink extends CoreModel
{
    use OnlineModel;

    protected $fillable = [
        'slug',
        'parent_id',
        'class_type',
        'model_id',
        'action',
        'final_path',
        'params'
    ];

    protected $casts = [
        'final_path' => 'json',
        'slug' => 'json',
        'params' => 'json'
    ];

    protected $attributes = [
        'params' => '{}'
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public static function boot()
    {
        parent::boot();
        static::observe(CmsLinkObserver::class);
    }

    public function getFinalPath($locale = false)
    {
        if (!$locale) {
            $locale = app()->getLocale();
        }
        if (isset($this->final_path[$locale])) {
            return $this->final_path[$locale];
        }
        return $this->final_path;
    }

    /**
     * Get the default verbs.
     *
     * @return array
     */
    public function getMethodAttribute()
    {
        return ['GET', 'HEAD'];
    }
}
