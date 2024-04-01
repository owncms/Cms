<?php

namespace Modules\Cms\App\src\VisitorManager;

use Illuminate\Http\Request;
use Modules\Cms\App\Models\CmsVisitor;

abstract class Visitor
{
    protected $model;
    protected $request;
    protected $visitorClass = CmsVisitor::class;

    /**
     * @param $model
     * @param Request $request
     */
    public function __construct($model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getVisitorClass()
    {
        return new $this->visitorClass;
    }

    public function getModelClassType()
    {
        return get_class($this->model);
    }
}
