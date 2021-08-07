<?php

namespace Modules\Cms\Http\Controllers\Backend;

use Modules\Admin\Http\Controllers\Controller as CoreController;
use Modules\Cms\Entities\Language;
use Modules\Cms\Forms\LanguageForm;
use Modules\Cms\Http\Requests\LanguageRequest;

class LanguageController extends CoreController
{
    public function __construct()
    {
        $this->model = Language::class;
        $this->form = LanguageForm::class;
        $this->baseView = 'panel.languages';
        $this->baseRoute = 'languages';
        $this->request = LanguageRequest::class;
        $this->searchableColumns = [
            'name',
            'url'
        ];
        parent::__construct();
    }
}
