<?php

namespace Modules\Cms\Http\Controllers\Frontend;

use Modules\Core\Http\Controllers\BaseController;
use Modules\Cms\Entities\Domain;
use Modules\Cms\Forms\DomainForm;
use Modules\Cms\Http\Requests\DomainRequest;
use Facuz\Theme\Contracts\Theme;

class Controller extends BaseController
{
    public $domain;
    protected $theme;

    public function __construct(Theme $theme)
    {
        $this->domain = resolve('Domain');
        $this->theme = $theme->layout('default');
    }

    /**
     * @param $view
     * @param $data
     * @return \Illuminate\Http\Response
     */
    public function view($view, $data = [])
    {
        return $this->theme->scope($view, $data)->render();
    }
}
