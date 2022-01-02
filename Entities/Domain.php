<?php

namespace Modules\Cms\Entities;

use Modules\Cms\Entities\DomainLanguage;
use Modules\Cms\Entities\Language;
use Illuminate\Support\Facades\App;

class Domain extends CmsModel
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

    public function languages(): object
    {
        return Language::all();
    }

    public function selectedLanguages(): object
    {
        return $this->belongsToMany(
            Language::class,
            'domain_language',
            'domain_id',
            'language_id'
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

    public function getDefaultLanguageAttribute(): mixed
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
        if ($this->url != '*') {
            config(
                [
                    'app.url' => $this->url,
                ]
            );
        }

        $app->singleton('Domain', function () {
            return $this;
        });
    }
}
