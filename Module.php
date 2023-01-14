<?php

namespace Modules\Cms;

use Illuminate\Support\Facades\Artisan;
use Modules\Cms\Entities\CmsDomain;
use Modules\Cms\Entities\CmsLanguage;
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
        $domain = CmsDomain::withTrashed()->first();
        if (!$domain) {
            $data = [
                'name' => 'Default',
                'active' => 1,
                'default' => 1
            ];
            $domain = CmsDomain::create($data);
            $language = CmsLanguage::where('locale', 'en')->first();
            if (!$language) {
                $language = CmsLanguage::create(
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
