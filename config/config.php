<?php

use Modules\Cms\App\Models\CmsDomain;

return [
    'name' => 'Cms',
    'observers' => [
        CmsDomain::class => \Modules\Cms\App\Observers\CmsDomainObserver::class
    ]
];
