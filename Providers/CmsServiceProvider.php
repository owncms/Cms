<?php

namespace Modules\Cms\Providers;

use Modules\Cms\Entities\Domain;
use Modules\Cms\Entities\Language;
use Modules\Cms\Observers\DomainObserver;
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
        $this->registerObservers();

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
    }

    public function registerObservers()
    {
        Domain::observe(DomainObserver::class);
    }

    public function setDomain()
    {
        $request = request();
        $host = $request->getHost();
        $domain = Domain::where('url', $host)->where('active', 1)->first();
        if (!$domain) {
            $domain = Domain::where('default', 1)->where('active', 1)->first();
        }
        if ($domain) {
            $domain->init();
        }
    }

    public function setBackend()
    {
        $app = $this->app;
        $app->singleton('Languages', function () {
            return Language::all();
        });
    }
}
