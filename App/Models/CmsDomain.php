<?php

namespace Modules\Cms\App\Models;

use Carbon\Carbon;
use Modules\Cms\App\Models\CmsDomainLanguage;
use Modules\Cms\App\Models\CmsLanguage;
use Illuminate\Support\Facades\App;
use Modules\Cms\App\Scopes\JsonActiveScope;

class CmsDomain extends CmsModel
{
    protected $fillable = [
        'name',
        'url',
        'options',
        'active',
        'default',
    ];

    protected $casts = [
        'options' => 'json'
    ];

    protected static function boot()
    {
        parent::boot();
        unset(static::$globalScopes[static::class][JsonActiveScope::class]);
    }

    public function languages(): object
    {
        return CmsLanguage::all();
    }

    public function selectedLanguages(): object
    {
        return $this->belongsToMany(
            CmsLanguage::class,
            'cms_domain_language',
            'cms_domain_id',
            'cms_language_id'
        );
    }

    public function getSelectedLanguagesAttribute(): object
    {
        return $this->selectedLanguages()->get();
    }

    public function selectedLanguagesInForm()
    {
        return $this->selectedLanguages()->get()->pluck('id')->toArray();
    }

    public function defaultLanguage(): object
    {
        return $this->selectedLanguages()->where('default', 1);
    }

    public function getDefaultLanguageAttribute()
    {
        if ($defaultLanguage = $this->defaultLanguage()) {
            return $defaultLanguage->first();
        }
        return null;
    }

    public function init(): void
    {
        $app = app();
        $defaultLanguage = $this->default_language;
        App::setLocale($defaultLanguage->locale);
        Carbon::setLocale($defaultLanguage->locale);
        if ($this->url != '*') {
            config(
                [
                    'app.url' => $this->url,
                ]
            );
        }

        $app->singleton('CmsDomain', function () {
            return $this;
        });
    }
}
