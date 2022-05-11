<?php

use Modules\Cms\Entities\CmsDomain;

return [
    'name' => 'Cms',
    'observers' => [
        CmsDomain::class => \Modules\Cms\Observers\CmsDomainObserver::class
    ]
];
