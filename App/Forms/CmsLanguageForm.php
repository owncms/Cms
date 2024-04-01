<?php

namespace Modules\Cms\App\Forms;

use Modules\Core\App\src\FormBuilder\Form;

class CmsLanguageForm extends Form
{
    public function buildForm()
    {
        $this->add('name');
        $this->add('locale');
        $this->add('date_format');
        $this->add('is_rtl', 'checkbox');
        $this->add('active', 'checkbox');
    }
}
