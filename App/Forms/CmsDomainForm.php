<?php

namespace Modules\Cms\App\Forms;

use Modules\Core\App\src\FormBuilder\Form;

class CmsDomainForm extends Form
{
    public function buildForm()
    {
        $this->add('name');
        $this->add('url');
        $this->add('active', 'checkbox');
        $this->add('default', 'checkbox');
        $this->add('options');
    }
}
