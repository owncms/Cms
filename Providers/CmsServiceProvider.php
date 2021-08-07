<?php

namespace Modules\Cms\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Cms\Entities\Domain;
use Modules\Cms\Entities\Language;
use Modules\Cms\Observers\DomainObserver;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path('Cms', 'Database/Migrations'));
        $this->registerObservers();

        if (config('core.route_status') == 'frontend') {
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

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Cms', 'Config/config.php') => config_path('cms.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Cms', 'Config/config.php'), 'cms'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/cms');

        $sourcePath = module_path('Cms', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/cms';
        }, \Config::get('view.paths')), [$sourcePath]), 'cms');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/cms');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'cms');
        } else {
            $this->loadTranslationsFrom(module_path('Cms', 'Resources/lang'), 'cms');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
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
