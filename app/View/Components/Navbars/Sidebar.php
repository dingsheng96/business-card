<?php

namespace App\View\Components\Navbars;

use Closure;
use App\Constants\Guard;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $guard = Guard::USER;

        if (Auth::guard(Guard::ADMIN)->check()) {
            $guard = Guard::ADMIN;
        }

        return view('components.navbars.sidebar', [
            'side_nav_items' => Cache::get('side_nav_' . $guard, [])
        ]);
    }
}
