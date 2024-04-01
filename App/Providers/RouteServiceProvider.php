<?php

namespace Modules\Cms\App\Providers;

use Modules\Core\App\Providers\Base\RouteServiceProvider as BaseRouteServiceProvider;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    protected string $moduleName = 'Cms';
    protected string $moduleNameLower = 'cms';
}
