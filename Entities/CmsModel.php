<?php

namespace Modules\Cms\Entities;

use Modules\Cms\Scopes\JsonActiveScope;
use Modules\Cms\src\SeoManager\Traits\SeoHelper;
use Modules\Cms\Traits\Mediable;
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
    use Mediable;
    use SeoHelper;

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

    protected static function boot()
    {
        parent::boot();
        return static::addGlobalScope(new JsonActiveScope);
    }

    /**
     * @return \string[][]
     */
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
        $request = request();
        if (!$field) {
            if ($request->route() && in_array($request->route()->getActionMethod(), ['edit'])) {
                $field = 'id';
            } else {
                $field = 'slug';
            }
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

    /**
     * @return mixed
     */
    public function getSeo()
    {
        $class = get_class($this);
        $item = CmsSeoData::where('class_type', $class)->where('model_id', $this->id)->first();
        if (!$item) {
            $item = CmsSeoData::create(
                [
                    'class_type' => $class,
                    'model_id' => $this->id
                ]
            );
        }
        return $item;
    }
}
