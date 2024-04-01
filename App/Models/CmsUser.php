<?php

namespace Modules\Cms\App\Models;

use Modules\Core\App\Models\CoreModel;
use Modules\Admin\App\Traits\OnlineModel;
use Modules\Core\App\Models\AuthModel;

class CmsUser extends AuthModel
{
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
