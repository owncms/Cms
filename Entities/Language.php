<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'locale',
        'date_format',
        'is_rtl',
        'options'
    ];

    protected $casts = [
        'options' => 'json'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

}
