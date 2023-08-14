<?php

namespace App\Http\Livewire\Admin\Auth;

use App\Models\Admin;
use Livewire\Component;
use App\Constants\Guard;
use App\Constants\Status;
use App\Models\ActivityLog;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public $email = "";
    public $password = "";
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
        'remember' => 'boolean'
    ];

    public function render()
    {
        return view('livewire.admin.auth.login');
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

    protected function credentials()
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'status' => Status::ADMIN_STATUS_ACTIVE
        ];
    }

    public function login()
    {
        $this->validate();

        if ($this->guard()->attempt($this->credentials(), $this->remember)) {

            Session::regenerate();

            return $this->authenticated($this->guard()->user());
        }

        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    protected function authenticated(Admin $user)
    {
        activity('admin_login')
            ->causedBy($user)
            ->withProperties(Arr::except($this->credentials(), (new ActivityLog())->getHiddenInputs()))
            ->log('Admin [' . $user->name . '] login successfully');

        return redirect()->route('admin.dashboard');
    }
}
