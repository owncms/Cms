<?php

namespace Modules\Cms\Entities;

use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\Admin\Traits\OnlineModel;
use Modules\Core\Traits\Translatable;

class CmsModel extends CoreModel
{
    use SoftDeletes;
    use OnlineModel;
    use Translatable;
    use Sluggable;

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public array $translatable = [
        'name',
        'slug',
        'short_content',
        'content'
    ];

//    public function scopeActive($query, $active = 1)
//    {
//        return $query->whereRaw('json_')
//    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param mixed $value
     * @param string|null $field
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        if (!config('system.is_frontend')) {
            return parent::resolveRouteBinding($value, $field);
        }
        $locale = app()->getLocale();
        if (!$field) {
            $field = 'slug';
        }
        $whereClause = '';
        if (property_exists($this, 'translatable')) {
            if (is_array($this->translatable) && in_array($field, $this->translatable)) {
                $whereClause = "$field->$locale";
            }
        }
        if (!$whereClause) {
            $whereClause = $field;
        }

        return $this->where($whereClause, $value)->firstOrFail();
    }
}
