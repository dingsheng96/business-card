<?php

namespace App\Http\Livewire\Admin\Auth;

use Livewire\Component;
use App\Constants\Guard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout extends Component
{
    public function render()
    {
        return view('livewire.admin.auth.logout');
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

    public function logout()
    {
        $user = $this->guard()->user();

        activity('admin_logout')
            ->causedBy($user)
            ->log('Admin [' . $user->name . '] logout successfully');

        $this->guard()->logout();

        Session::invalidate();
        Session::regenerateToken();

        return redirect()->route('admin.login');
    }
}
