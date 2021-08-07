<?php

namespace Modules\Cms\Entities;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
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
