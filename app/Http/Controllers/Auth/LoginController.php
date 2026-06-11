<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    /**
     * Handle a login request to the application.
     * Try admin (web) guard first, then supplier guard.
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // Check for too many login attempts
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // First, try admin (web) guard
        if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/admin/dashboard');
        }

        // If admin auth fails, try supplier guard
        if (Auth::guard('supplier')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->intended('/supplier/dashboard');
        }

        // If both fail, increment attempts and return error
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }


    public function logout(){

        Auth::guard('web')->logout();
        Auth::guard('supplier')->logout();

        return redirect()->route('login')->with('success', __('auth_logged_out'));
    }
}
