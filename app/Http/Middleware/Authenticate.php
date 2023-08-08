<?php

namespace App\Http\Middleware;

use ErrorException;
use App\Constants\Guard;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return string|null
     */
    protected function redirectTo(Request $request, array $guards = []): ?string
    {
        if (!$request->expectsJson()) {

            if (in_array(Guard::ADMIN, $guards)) {
                return route('admin.login', $request->route()->parameters());
            }

            return route('web.login', $request->route()->parameters());
        }

        return parent::redirectTo($request);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException("Unauthenticated", $guards, $this->redirectTo($request, $guards));
    }
}
