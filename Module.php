<?php

namespace Modules\Cms;

use Illuminate\Support\Facades\Artisan;
use Modules\Cms\Entities\Domain;
use Modules\Cms\Entities\Language;
use Modules\Core\src\Modules\BaseModule;

class Module extends BaseModule
{
    public function __construct($module)
    {
        parent::__construct($module);
    }

    public function install()
    {
        Artisan::call('module:migrate Cms');
        $this->checkDomain();
    }

    public function checkDomain()
    {
        $domain = Domain::withTrashed()->first();
        if (!$domain) {
            $data = [
                'name' => 'Default',
                'active' => 1,
                'default' => 1
            ];
            $domain = Domain::create($data);
            $language = Language::where('locale', 'en')->first();
            if (!$language) {
                $language = Language::create(
                    [
                        'name' => 'English',
                        'locale' => 'en',
                        'date_format' => 'Y-m-d H:i'
                    ]
                );
            }
            $domain->selectedLanguages()->sync([0 => ['language_id' => $language->id, 'default' => 1]]);
        }
    }
}
