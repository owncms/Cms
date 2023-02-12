<?php

namespace Modules\Cms\src\SearchEngine;

use Modules\Cms\Entities\CmsDomain;
use Modules\Core\Facades\Application;

class SearchEngine
{
    private $searchableModels = [];
    private $modules;
    private $domain;

    public function __construct(CmsDomain $domain)
    {
        $this->domain = $domain;
        $this->setActiveModules();
        $this->setSearchableModels();
    }

    /**
     * @return void
     */
    public function setActiveModules()
    {
        $this->modules = resolve('Modules');
    }

    /**
     * @return void
     */
    public function setSearchableModels()
    {
        $models = [];
        foreach ($this->modules as $module) {
            $attributes = $module->json()->getAttributes();
            if (!isset($attributes['searchables'])) {
                continue;
            }
            if (!is_array($attributes['searchables'])) {
                $attributes['searchables'] = [$attributes['searchables']];
            }
            $models[$module->getName()] = $attributes['searchables'];
        }
        $this->searchableModels = $models;
    }

    /**
     * @return bool
     */
    public function hasSearchableModels($moduleName = false)
    {
        if (!$moduleName) {
            return false;
        }
        return isset($this->searchableModels[$moduleName]) && count($this->searchableModels[$moduleName]);
    }

    /**
     * @param $moduleName
     * @return array|mixed
     */
    public function getSearchableModels($moduleName = false)
    {
        if (!$moduleName) {
            return $this->searchableModels;
        }
        if (isset($this->searchableModels[$moduleName])) {
            return $this->searchableModels[$moduleName];
        }
        return [];
    }
}

