<?php

namespace Modules\Cms\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        dd($this->domain);
    }
}
