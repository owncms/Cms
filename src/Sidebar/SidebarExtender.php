<?php

namespace Modules\Cms\src\Sidebar;

use Modules\Admin\src\Sidebar\AbstractAdminSidebar;
use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Bouncer;
use Modules\Cms\Entities\CmsDomain;
use Modules\Cms\Entities\CmsLanguage;

class SidebarExtender extends AbstractAdminSidebar
{
    public function extendWith(Menu $menu): object
    {
        $permissions = [
            'canDomain' => Bouncer::can('index', CmsDomain::class),
            'canLanguage' => Bouncer::can('index', CmsLanguage::class),
        ];

        if ($this->hasAnyPermissions($permissions)) {
            $menu->group($this->getModuleName(), function (Group $group) use ($permissions) {
                $group->item(trans('cms::sidebar.cms'), function (Item $item) use ($permissions) {
                    $item->icon('fa fa-tasks');
                    if ($permissions['canDomain']) {
                        $item->item(trans('cms::sidebar.domains'), function (Item $item) {
                            $item->route($this->adminRoute('cms.domains.index'));
                            $item->icon('');
                        });
                    }
                    if ($permissions['canLanguage']) {
                        $item->item(trans('cms::sidebar.languages'), function (Item $item) {
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
