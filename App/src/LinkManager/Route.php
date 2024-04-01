<?php

namespace Modules\Cms\App\src\LinkManager;

use \Illuminate\Routing\Route as BaseRoute;

class Route extends BaseRoute
{
    public function __construct($methods, $uri, $action, $cmsLink = null)
    {
        parent::__construct($methods, $uri, $action);

        $this->cmsLink = $cmsLink;
    }

    public function setCmsLink($cmsLink)
    {
        $this->cmsLink = $cmsLink;
    }

    public function isCmsLink()
    {
        return $this->cmsLink;
    }
}
