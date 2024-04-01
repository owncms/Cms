<?php

namespace Modules\Cms\App\Providers;

use Illuminate\Routing\Router;
use Modules\Cms\App\Models\CmsDomain;
use Modules\Cms\App\Models\CmsLanguage;
use Modules\Cms\App\Observers\CmsDomainObserver;
use Modules\Cms\App\src\LinkManager\Router as ExtendedRouter;
use Modules\Cms\App\src\SeoManager\SeoManager;
use Modules\Core\App\Providers\Base\ModuleServiceProvider;

class CmsServiceProvider extends ModuleServiceProvider
{
    protected string $moduleName = 'Cms';
    protected string $moduleNameLower = 'cms';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        parent::boot();

        if ($this->getApplication()->isAppInstalled()) {
            if ($this->getApplication()->isFrontend()) {
                $this->setDomain();
            }
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        Router::macro('replaceMiddleware', function ($middleware = [], $middlewareGroups = []) {
            $this->middleware = $middleware;
            $this->middlewareGroups = $middlewareGroups;
        });
        $this->app->singleton('router', ExtendedRouter::class);
        $this->app->singleton('SeoManager', function () {
            return new SeoManager;
        });
    }

    /**
     * @return void
     */
    public function setDomain(): void
    {
        $request = request();
        $host = $request->getHost();
        $domain = CmsDomain::where('url', $host)->where('active', 1)->first();
        if (!$domain) {
            $domain = CmsDomain::where('default', 1)->where('active', 1)->first();
        }
        if ($domain) {
            $domain->init();
        }
    }
}
