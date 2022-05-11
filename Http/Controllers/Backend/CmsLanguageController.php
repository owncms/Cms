<?php

namespace Modules\Cms\Http\Controllers\Backend;

use Modules\Admin\Http\Controllers\Controller as CoreController;
use Modules\Cms\Entities\CmsLanguage;
use Modules\Cms\Forms\CmsLanguageForm;
use Modules\Cms\Http\Requests\CmsLanguageRequest;

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
