<?php

namespace Modules\Cms\Http\Controllers\Backend;

use Modules\Admin\Http\Controllers\Controller as CoreController;
use Modules\Cms\Entities\Domain;
use Modules\Cms\Forms\DomainForm;
use Modules\Cms\Http\Requests\DomainRequest;

class DomainController extends CoreController
{
    public function __construct()
    {
        $this->model = Domain::class;
        $this->form = DomainForm::class;
        $this->baseView = 'panel.domains';
        $this->baseRoute = 'domains';
        $this->request = DomainRequest::class;
        $this->searchableColumns = [
            'name',
            'url'
        ];
        parent::__construct();
    }
}
