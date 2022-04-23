<?php

namespace Modules\Cms\Http\Controllers\Backend;

use Modules\Admin\Http\Controllers\Controller as CoreController;
use Modules\Cms\Entities\Domain;
use Modules\Cms\Forms\DomainForm;
use Modules\Cms\Http\Requests\DomainRequest;
use Bouncer;
use Modules\Cms\src\SearchEngine\SearchEngine;

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

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id): object
    {
        $item = $this->model::withTrashed()->findOrFail($id);
        if (!Bouncer::can('edit', $item)) {
            return abort(403);
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
