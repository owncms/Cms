<?php

namespace Modules\Cms\Http\Controllers\Frontend;

use Facuz\Theme\Contracts\Theme;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        return $this->view(
            'cms.profile.dashboard',
            [
                'item' => $user
            ]
        );
    }

    public function edit()
    {
        $user = auth()->user();
        return $this->view(
            'cms.profile.edit',
            [
                'item' => $user
            ]
        );
    }

    public function update(Request $request)
    {
        dd($request->all());
    }
}
