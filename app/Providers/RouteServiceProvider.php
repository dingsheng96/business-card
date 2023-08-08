<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "dashboard" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const DASHBOARD = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {

            // Route::middleware('api')
            //     ->name('api.')
            //     ->namespace('App\\Http\\Controllers\\Api')
            //     ->domain('api.' . config('app.host'))
            //     ->prefix('v1')
            //     ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->name('web.')
                ->namespace('App\\Http\\Controllers')
                ->domain(config('app.host'))
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->name('admin.')
                ->namespace('App\\Http\\Controllers\\Admin')
                ->domain('portal.' . config('app.host'))
                ->group(base_path('routes/admin.php'));
        });
    }
}
