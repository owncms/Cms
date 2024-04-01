<?php

namespace Modules\Cms\App\Http\Controllers\Frontend;

use Modules\Cms\App\src\LinkManager\ShortLinkManager;
use Modules\Core\App\Http\Controllers\BaseController;

class ShortLinkController extends BaseController
{
    /**
     * @param $hash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($hash)
    {
        $url = (new ShortLinkManager(['hash' => $hash]))->decode()->getDecodedUrl();
        return redirect()->to($url);
    }
}
