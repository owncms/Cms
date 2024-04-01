<?php

namespace Modules\Cms\App\src\LinkManager;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router as BaseRouter;
use Modules\Cms\App\Models\CmsLink;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Router extends BaseRouter
{
    /**
     * @param $request
     * @return \Illuminate\Routing\Route|void
     */
    public function findRoute($request)
    {
        try {
            return parent::findRoute($request);
        } catch (\Exception $e) {
            $this->findCmsRoute($request);
        }
        return parent::findRoute($request);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function findCmsRoute(Request $request)
    {
        $locale = app()->getLocale();
        if (!$cmsLink = CmsLink::where('final_path->' . $locale, $request->path())->first()) {
            throw new NotFoundHttpException;
        }

//        $this->group([], function () use ($cmsLink) {
            $this->appendCmsLink($cmsLink);
//        });
    }

    protected function appendCmsLink($cmsLink)
    {
        if ($cmsLink->action) {
            $route = $this->createCmsLink($cmsLink);
            if ($this->hasGroupStack()) {
                $this->mergeGroupAttributesIntoRoute($route);
            }

            $this->addWhereClausesToRoute($route);

            $this->routes->add($route);
        }
    }

    public function createCmsLink($cmsLink)
    {
        $path = $this->prefix($cmsLink->getFinalPath());
        $action = $this->convertToControllerAction($cmsLink->action);

        return tap($this->newRoute($cmsLink->method, $path, $action), function ($route) use ($cmsLink) {
            $route->setCmsLink($cmsLink);
        });
    }

    public function newRoute($methods, $path, $action)
    {
        return (new Route($methods, $path, $action))
            ->setRouter($this)
            ->setContainer($this->container);
    }

    /**
     * Refresh the route name and action lookups.
     */
    public function refreshRouteLookups()
    {
        $this->getRoutes()->refreshNameLookups();
        $this->getRoutes()->refreshActionLookups();
    }
}
