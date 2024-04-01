<?php

namespace Modules\Cms\App\Http\Controllers\Frontend;

use Facuz\Theme\Contracts\Theme;
use Illuminate\Http\Request;
use Modules\Cms\App\Http\Requests\Frontend\CmsUserRequest;

class ProfileController extends Controller
{
    public function dashboard()
    {
        if (!auth()->check()) {
            return redirect(route('Front::cms.login'));
        }
        $user = auth()->user();
        return $this->view(
            'cms.profile.dashboard',
            [
                'item' => $user
            ]
        );
    }

    /**
     * @return \Illuminate\Http\Response
     */
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

    /**
     * @param CmsUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CmsUserRequest $request)
    {
        $user = auth()->user();
        $data = $request->all();
        if (!isset($data['password']) || !$data['password']) {
            unset($data['password'], $data['password_confirmation']);
        }
        $user->update($data);
        return redirect()->back()->with('success', 'Your account has been updated!');
    }
}
