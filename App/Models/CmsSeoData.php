<?php

namespace Modules\Cms\App\Models;

use Modules\Core\App\Models\CoreModel;

class CmsSeoData extends CoreModel
{
    protected $fillable = [
        'class_type',
        'model_id',
        'params'
    ];

    protected $casts = [
        'params' => 'json'
    ];

    protected $attributes = [
        'params' => '{}'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity()
    {
        return $this->belongsTo($this->class_type, 'model_id', 'id');
    }

    public function getEntityAttribute()
    {
        return $this->entity()->first();
    }
}
