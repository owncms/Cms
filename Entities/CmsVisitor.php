<?php

namespace Modules\Cms\Entities;

use Illuminate\Support\Facades\Crypt;
use Modules\Admin\Traits\OnlineModel;
use Modules\Core\Entities\CoreModel;

class CmsVisitor extends CoreModel
{
    use OnlineModel;

    protected $fillable = [
        'class_type',
        'model_id',
        'ip',
        'user_agent',
        'clicks',
        'cms_user_id',
        'params'
    ];

    protected $casts = [
        'params' => 'json'
    ];

    protected $attributes = [
        'params' => '{}'
    ];

    public function user()
    {
        return $this->belongsTo(CmsUser::class, 'cms_user_id', 'id');
    }

    /**
     * @param $value
     * @return void
     */
    public function setIpAttribute($value)
    {
        $this->attributes['ip'] = Crypt::encrypt($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getIpAttribute($value)
    {
        if (!config('system.is_frontend')) {
            return Crypt::decrypt($value);
        }
        return $value;
    }
}
