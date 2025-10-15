<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/signature.php'));

            Route::middleware('web')
                ->group(base_path('routes/esia_routes.php'));

            Route::middleware('web')
                ->group(base_path('routes/asmi_auth.php'));

            Route::middleware('web')
                ->group(base_path('routes/asmi_user_data.php'));

            Route::middleware('web')
                ->group(base_path('routes/document_types.php'));

            // Route::middleware('web')
            //     ->group(base_path('routes/project.php'));

            // Route::middleware('web')
            //     ->group(base_path('routes/area_get.php'));

            // Route::middleware('web')
            //     ->group(base_path('routes/support.php'));

            // Route::middleware('web')
            //     ->group(base_path('routes/tc.php'));

            Route::middleware('web')
                ->group(base_path('routes/information.php'));

            Route::middleware('web')
                ->group(base_path('routes/cabinet.php'));

            Route::middleware('web')
                ->group(base_path('routes/goskey.php'));
        });
    }
}
