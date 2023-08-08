<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Constants\Guard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

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
        // $user = $this->guard()->user();

        // activity()->useLog('logout')
        //     ->causedBy($user)
        //     ->withProperties($request->except(Activity::requestExceptInputs()))
        //     ->log(__('messages.logout.success'));

        return $this->traitLogout($request);
    }

    protected function loggedOut(Request $request)
    {
        return redirect()
            ->route('admin.login')
            ->withSuccess("You've logged out!");
    }
}
