<?php

namespace Modules\Cms\Forms;

use Modules\Core\src\FormBuilder\Form;

class DomainForm extends Form
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
