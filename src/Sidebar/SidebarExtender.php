<?php

namespace Modules\Cms\src\Sidebar;

use Modules\Admin\src\Sidebar\AbstractAdminSidebar;
use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Bouncer;
use Modules\Cms\Entities\Domain;
use Modules\Cms\Entities\Language;

class SidebarExtender extends AbstractAdminSidebar
{
    public function extendWith(Menu $menu): object
    {
        $canDomain = Bouncer::can('index', Domain::class);
        $canLanguage = Bouncer::can('index', Language::class);
        if ($canDomain) {
            $menu->group($this->getModuleName(), function (Group $group) use ($canDomain, $canLanguage) {
                $group->item('Cms', function (Item $item) use ($canDomain, $canLanguage) {
                    $item->icon('fa fa-tasks');
                    if ($canDomain) {
                        $item->item('Domains', function (Item $item) {
                            $item->route($this->adminRoute('cms.domains.index'));
                            $item->icon('');
                        });
                    }
                    if ($canLanguage) {
                        $item->item('Languages', function (Item $item) {
                            $item->route($this->adminRoute('cms.languages.index'));
                            $item->icon('');
                        });
                    }
                });
            });

        }
        return $menu;
    }

}
