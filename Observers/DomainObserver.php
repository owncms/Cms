<?php

namespace Modules\Cms\Observers;

use Modules\Cms\Entities\Domain;

class DomainObserver
{

    /**
     * Handle the User "updated" event.
     *
     * @param \Modules\Cms\Entities\Domain $domain
     * @return void
     */
    public function updating(Domain $domain)
    {
        if (request()->get('active') == 0) {
            $domain->default = 0;
        }
    }

    /**
     * Handle the Domain "saved" event.
     *
     * @param \Modules\Cms\Entities\Domain $domain
     * @return void
     */
    public function saved(Domain $domain)
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
     * @param \Modules\Cms\Entities\Domain $domain
     * @return void
     */
    public function deleting(Domain $domain)
    {
        $domain->default = 0;
        $domain->active = 0;
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param \Modules\Cms\Entities\Domain $domain
     * @return void
     */
    public function deleted(Domain $domain)
    {
        //
    }
}
