<?php

namespace Modules\Cms\App\Models;

use Modules\Cms\App\src\LinkManager\CmsLinkObserver;
use Modules\Core\App\Models\CoreModel;
use Modules\Admin\App\Traits\OnlineModel;

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
