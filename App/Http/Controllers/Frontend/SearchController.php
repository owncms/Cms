<?php

namespace Modules\Cms\App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        dd($this->domain);
    }
}
