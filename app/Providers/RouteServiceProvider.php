<?php
namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
    {
        parent::boot();
        Passport::$revokeOtherTokens = true;
        Passport::$pruneRevokedTokens;
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }

    /**
     * Define the routes for the application.
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapUserRoutes();
        $this->mapAdminRoutes();
        $this->mapAdvertiserRoutes();
        Passport::routes();
    }

    /**
     * Define the "user" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapUserRoutes()
    {
        Route::group([
            'middleware' => 'user',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require base_path('routes/user.php');
        });
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => 'admin',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapAdvertiserRoutes()
    {
        Route::group([
            'middleware' => 'advertiser',
            'namespace'  => $this->namespace,
        ], function ($router) {
            require base_path('routes/advertiser.php');
        });
    }
}
