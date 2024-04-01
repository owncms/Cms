<?php

namespace Modules\Cms\App\Http\Controllers\Backend;

use Modules\Admin\App\Http\Controllers\Controller as CoreController;
use Modules\Cms\App\Models\CmsDomain;
use Modules\Cms\App\Forms\CmsDomainForm;
use Modules\Cms\App\Http\Requests\CmsDomainRequest;
use Bouncer;
use Modules\Cms\App\src\SearchEngine\SearchEngine;

class CmsDomainController extends CoreController
{
    public function __construct()
    {
        $this->model = CmsDomain::class;
        $this->form = CmsDomainForm::class;
        $this->baseView = 'panel.domains';
        $this->baseRoute = 'domains';
        $this->request = CmsDomainRequest::class;
        $this->searchableColumns = [
            'name',
            'url'
        ];
        parent::__construct();
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id): object
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        if (!Bouncer::can('edit', $item)) {
            abort(403);
        }
        $form = $this->form($this->form, [
            'method' => 'PUT',
            'route' => [$this->routeWithModulePrefix . '.update', $item->id],
            'model' => $item
        ]);
        $searchEngine = new SearchEngine($item);
        $searchableModels = $searchEngine->getSearchableModels();

        $entity = new $this->model;
        return $this->view($this->baseView . '.edit', compact(['item', 'form', 'entity', 'searchableModels']));
    }
}
