<?php

namespace Modules\Cms\App\src\VisitorManager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Modules\Cms\App\src\VisitorManager\Contracts\VisitorManager as VisitorManagerContract;
use Modules\Cms\App\src\VisitorManager\Traits\VisitorsHelper;

class VisitorManager extends Visitor implements VisitorManagerContract
{
    protected $canBeRegister = false;

    /**
     * @param $model
     * @param Request $request
     */
    public function __construct($model, Request $request)
    {
        parent::__construct($model, $request);
        $this->init();
    }

    /**
     * @return void
     */
    public function init()
    {
        $this->canBeRegister = auth()->check();
    }

    /**
     * @return mixed
     */
    public function prepareModelData()
    {
        return [
            'class_type' => $this->getModelClassType(),
            'model_id' => $this->model->id,
            'ip' => $this->getIp(),
            'user_agent' => $this->getUserAgent(),
            'cms_user_id' => auth()->check() ? auth()->id() : null
        ];
    }

    /**
     * Register visit of the model
     * @return void
     */
    public function register()
    {
        if (!$this->canBeRegister) {
            return;
        }
        $data = $this->prepareModelData();
        $visitorModel = $this->getVisitorClass()
            ->where('class_type', $data['class_type'])
            ->where('model_id', $data['model_id'])
            ->where('cms_user_id', $data['cms_user_id'])
            ->first();
        if (!$visitorModel) {
            $this->getVisitorClass()->create($data);
        }
    }

    /**
     * Get client IP from request
     * @return string|null
     */
    public function getIp()
    {
        return $this->request->ip();
    }

    /**
     * @return array|string|null
     */
    public function getUserAgent()
    {
        return $this->request->header('User-Agent');
    }
}
