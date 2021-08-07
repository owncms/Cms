<?php

namespace Modules\Cms\Forms;

use Modules\Core\src\FormBuilder\Form;

class LanguageForm extends Form
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
