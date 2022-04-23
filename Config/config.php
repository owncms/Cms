<?php

use Modules\Cms\Entities\Domain;

return [
    'name' => 'Cms',
    'observers' => [
        Domain::class => \Modules\Cms\Observers\DomainObserver::class
    ]
];
