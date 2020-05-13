<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        credentials as _credentials;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * What needs for login as admin
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $this->_credentials($request);

        return array_merge($credentials, ['admin_flag' => true]);
    }

    // Guard for admin
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Logout function for admin
     * Only admin session will delete
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    protected function logout(Request $request)
    {
        $this->guard('admin')->logout();
        return redirect(route('admin.login'));
    }

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }
}
