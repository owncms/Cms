<?php

namespace Modules\Cms\App\Forms;

use Modules\Cms\App\src\SeoManager\Traits\SeoHelperBackend;
use Modules\Core\App\src\FormBuilder\Form;

class BaseCmsForm extends Form
{
    use SeoHelperBackend;
}
