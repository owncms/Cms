<?php

namespace Modules\Cms\Http\Controllers\Frontend\Auth;

use Modules\Cms\Http\Controllers\Frontend\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Facuz\Theme\Contracts\Theme;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     */
    public function __construct(Theme $theme)
    {
        parent::__construct($theme);
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return $this->view('cms.auth.login');
    }
}
