<?php

namespace Modules\Cms\App\Http\Controllers\Backend;

use Modules\Admin\App\Http\Controllers\Controller as CoreController;
use Modules\Cms\App\Models\CmsLanguage;
use Modules\Cms\App\Forms\CmsLanguageForm;
use Modules\Cms\App\Http\Requests\CmsLanguageRequest;

class CmsLanguageController extends CoreController
{
    public function __construct()
    {
        $this->model = CmsLanguage::class;
        $this->form = CmsLanguageForm::class;
        $this->baseView = 'panel.languages';
        $this->baseRoute = 'languages';
        $this->request = CmsLanguageRequest::class;
        $this->searchableColumns = [
            'name',
            'url'
        ];
        parent::__construct();
    }
}
