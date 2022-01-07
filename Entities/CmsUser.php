<?php

namespace Modules\Cms\Entities;

use Modules\Core\Entities\CoreModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Cms\Traits\CmsTrait;
use Modules\Admin\Traits\OnlineModel;
use Modules\Core\Entities\AuthModel;

class CmsUser extends AuthModel
{
    use SoftDeletes;
    use CmsTrait;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'email_verified_at',
        'remember_token',
        'options'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'email_verified_at',
        'deleted_at'
    ];

    protected $casts = [
        'options' => 'array'
    ];

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
