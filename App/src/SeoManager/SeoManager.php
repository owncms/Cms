<?php

namespace Modules\Cms\App\src\SeoManager;

use Modules\Cms\App\Models\CmsSeoData;

class SeoManager
{
    protected $model;
    protected $seoModel;
    protected $domain;
    private $properties;
    private $render;

    /**
     * @param $model
     * @param $seoModel
     * @param $domain
     */
    public function __construct($model = null, $seoModel = null, $domain = null)
    {
        $this->setModel($model);
        $this->setSeoModel($seoModel);
        $this->setDomain($domain);
    }

    /**
     * Set model property
     * @param $item
     * @return void
     */
    public function setModel($model)
    {
        if (!$this->model && $model) {
            $this->model = $model;
        }
        return $this;
    }

    /**
     * Set Seo model property
     * @param $seoModel
     * @return void
     */
    public function setSeoModel($seoModel = null)
    {
        if (!$this->seoModel && $seoModel) {
            if (!$seoModel instanceof CmsSeoData && $this->model) {
                $seoModel = $this->model->getSeo();
            }
            $this->seoModel = $seoModel;
        }
        return $this;
    }

    /**
     * Set domain property
     * @return void
     */
    public function setDomain()
    {
        if (!$this->domain) {
            $this->domain = resolve('CmsDomain');
        }
        return $this;
    }

    /**
     * @param $model
     * @return array|mixed
     */
    public function setProperties($model)
    {
        $properties = $model->params;
        if (method_exists($this, 'addCustomSeoProperties')) {
            if (is_array($this->addCustomSeoProperties())) {
                $properties = array_merge($properties, $this->addCustomSeoProperties());
            }
        }
        $this->properties = $properties;
    }

    /**
     * @param $property
     * @param $value
     * @return void
     */
    public function setProperty($property, $value = ''): void
    {
        $this->properties[$property] = $value;
    }

    /**
     * @param ...$values
     * @return $this
     */
    public function except(...$values)
    {
        return $this;
    }

    public function render()
    {
        $render = '';
        if (is_array($this->properties)) {
            foreach ($this->properties as $propertyName => $propertyValue) {
                if (!is_null($propertyValue)) {
                    if ($propertyName == 'title') {
                        $render .= "<title>$propertyValue</title>";
                    } else {
                        $render .= '<meta name="' . $propertyName . '" content="' . $propertyValue . '">';
                    }
                    $render .= PHP_EOL;
                }
            }
        }
        return $render;
    }
}
