<?php

namespace Modules\Cms\App\src\VisitorManager\Contracts;

interface VisitorManager
{
    public function init();

    public function prepareModelData();

    public function register();

    public function getIp();

    public function getUserAgent();
}
