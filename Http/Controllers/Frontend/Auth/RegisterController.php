<?php

namespace Modules\Cms\Http\Controllers\Frontend\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Cms\Entities\CmsUser;
use Modules\Cms\Http\Controllers\Frontend\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Modules\Cms\Http\Requests\Frontend\RegisterRequest;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function showRegistrationForm()
    {
        if (auth()->check()) {
            return redirect(route('Front::cms.profile'));
        }
        return $this->view('cms.auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        event(new Registered($user = CmsUser::create($request->all())));
        dd($user);

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }
}
