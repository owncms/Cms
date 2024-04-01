<?php

namespace Modules\Cms\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CmsLanguage extends Model
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
