<?php

namespace Modules\Cms\App\src\SeoManager\Traits;

trait SeoHelper
{
    /**
     * Set dynamically seo property through the controller
     * @param $title
     * @return void
     */
    public function setSeoTitle($title, $limit = 150)
    {
        $this->seo->setProperty('title', $title);
    }

    /**
     * Set dynamically seo property through the controller
     * @param $description
     * @return void
     */
    public function setSeoDescription($description)
    {
        $this->seo->setProperty('description', $description);
    }

    /**
     * Set dynamically seo property through the controller
     * @param $keywords
     * @return void
     */
    public function setSeoKeywords($keywords)
    {
        if (is_array($keywords)) {
            $keywords = implode(', ', $keywords);
        }
        $this->seo->setProperty('keywords', $keywords);
    }
}
