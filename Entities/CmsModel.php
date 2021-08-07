<?php

namespace Modules\Cms\Entities;

use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\Cms\Traits\CmsTrait;
use Modules\Admin\Traits\OnlineModel;
use Modules\Core\Traits\Translatable;

class CmsModel extends CoreModel
{
    use SoftDeletes,
        CmsTrait,
        OnlineModel,
        Translatable;

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public array $translatable = [
        'name',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->bootBaseTrait();
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
