<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class RouteServiceProvider extends ServiceProvider
{
    //public conts HOME = '/admin/dashboard/';
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public static function redirectTo()
    {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return '/admin/dashboard';
    }

    if ($user->role === 'pelaku_umkm') {
        return '/pelaku-umkm/dashboard';
    }

    if ($user->role === 'pembeli') {
        return '/pembeli/dashboard';
    }

    return '/'; // fallback
}// breeze ngambilnya dari sini ternyata *catatan penting

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Configure the route model bindings.
     */
    protected function configureRouteModelBindings(): void
    {
        Route::model('image', \App\Models\ProductImage::class);
    }

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();
        $this->configureRouteModelBindings();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

}
