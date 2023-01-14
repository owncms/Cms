<?php

namespace Modules\Cms\Http\Controllers\Frontend;

use Modules\Cms\src\LinkManager\ShortLinkManager;
use Modules\Core\Http\Controllers\BaseController;

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
