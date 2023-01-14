<?php

namespace Modules\Cms\Providers;

use Illuminate\Routing\Router;
use Modules\Cms\Entities\CmsDomain;
use Modules\Cms\Entities\CmsLanguage;
use Modules\Cms\Observers\CmsDomainObserver;
use Modules\Cms\src\LinkManager\Router as ExtendedRouter;
use Modules\Cms\src\SeoManager\SeoManager;
use Modules\Core\Providers\Base\ModuleServiceProvider;

class CmsServiceProvider extends ModuleServiceProvider
{
    protected string $moduleName = 'Cms';
    protected string $moduleNameLower = 'cms';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        if ($this->getApplication()->isFrontend()) {
            $this->setDomain();
        } else {
            $this->setBackend();
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        Router::macro('replaceMiddleware', function ($middleware = [], $middlewareGroups = []) {
            $this->middleware = $middleware;
            $this->middlewareGroups = $middlewareGroups;
        });
        $this->app->singleton('router', ExtendedRouter::class);
        $this->app->singleton('SeoManager', function () {
            return new SeoManager;
        });
    }

    public function setDomain()
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

    public function setBackend()
    {
        $app = $this->app;
        $app->singleton('CmsLanguages', function () {
            return CmsLanguage::all();
        });
    }
}
