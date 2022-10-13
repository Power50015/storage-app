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
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            $middleware = [
                'web',
                'auth:sanctum',
                config('jetstream.auth_session'),
                'verified',
            ];

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // App Routes
            Route::middleware($middleware)->group(base_path('routes/app/product.php'));
            Route::middleware($middleware)->group(base_path('routes/app/people.php'));
            Route::middleware($middleware)->group(base_path('routes/app/warehouse.php'));
            Route::middleware($middleware)->group(base_path('routes/app/kit.php'));
            Route::middleware($middleware)->group(base_path('routes/app/cash.php'));
            Route::middleware($middleware)->group(base_path('routes/app/incoming-invoice.php'));
            Route::middleware($middleware)->group(base_path('routes/app/debtor.php'));
            Route::middleware($middleware)->group(base_path('routes/app/outgoing-invoice.php'));
            Route::middleware($middleware)->group(base_path('routes/app/transfer.php'));
            
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
