<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use App\Constants\Guard;
use App\Constants\Status;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    use AuthenticatesUsers {
        logout as traitLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:' . Guard::ADMIN)->except('logout');
    }

    public function logout(Request $request)
    {
        $user = $this->guard()->user();

        activity('admin_logout')
            ->causedBy($user)
            ->withProperties($request->except((new ActivityLog())->getHiddenInputs()))
            ->log('Admin [' . $user->name . '] logout successfully');

        return $this->traitLogout($request);
    }

    protected function loggedOut(Request $request)
    {
        return redirect()
            ->route('admin.login')
            ->withSuccess("You've logged out!");
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(Guard::ADMIN);
    }

    protected function credentials(Request $request)
    {
        return array_merge(
            $request->only($this->username(), 'password'),
            ['status' => Status::ADMIN_STATUS_ACTIVE]
        );
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        activity('admin_login')
            ->causedBy($user)
            ->withProperties($request->except((new ActivityLog())->getHiddenInputs()))
            ->log('Admin [' . $user->name . '] login successfully');
    }
}
