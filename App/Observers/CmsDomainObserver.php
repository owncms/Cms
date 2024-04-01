<?php

namespace Modules\Cms\App\Observers;

use Modules\Cms\App\Models\CmsDomain;

class CmsDomainObserver
{

    /**
     * Handle the User "updated" event.
     *
     * @param \Modules\Cms\Entities\CmsDomain $domain
     * @return void
     */
    public function updating(CmsDomain $domain): void
    {
        if (request()->get('active') == 0) {
            $domain->default = 0;
        }
    }

    /**
     * Handle the Domain "saved" event.
     *
     * @param \Modules\Cms\Entities\CmsDomain $domain
     * @return void
     */
    public function saved(CmsDomain $domain): void
    {
        $data = request()->all();
        if (isset($data['selected_languages'])) {
            $selectedLanguages = $data['selected_languages'];
            $selectedLanguages[$data['default_language']] = ['default' => 1];
            $domain->selectedLanguages()->where('default', 1)->update(
                [
                    'default' => 0
                ]
            );
            $domain->selectedLanguages()->sync($selectedLanguages);
        }
    }

    /**
     * Handle the User "deleting" event.
     *
     * @param \Modules\Cms\Entities\CmsDomain $domain
     * @return void
     */
    public function deleting(CmsDomain $domain): void
    {
        $domain->default = 0;
        $domain->active = 0;
    }
}
