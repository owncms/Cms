<?php

namespace Modules\Cms\src\VisitorManager;

use Illuminate\Http\Request;
use Modules\Cms\src\VisitorManager\Contracts\VisitorStatisticManager as VisitorStatisticManagerContract;

class VisitorStatisticManager extends Visitor implements VisitorStatisticManagerContract
{
    public function getTotalVisitors()
    {
        return $this->getVisitorClass()
            ->where('class_type', $this->getModelClassType())
            ->where('model_id', $this->model->id)
            ->sum('clicks');
    }
}
