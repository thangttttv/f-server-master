<?php
namespace App\Http\Middleware\Advertiser;

use App\Services\AdvertiserServiceInterface;

class RedirectIfAuthenticated
{
    /** @var AdvertiserServiceInterface */
    protected $advertiserService;

    /**
     * Create a new filter instance.
     *
     * @param AdvertiserServiceInterface $adminUserService
     */
    public function __construct(AdvertiserServiceInterface $advertiserService)
    {
        $this->advertiserService = $advertiserService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if ($this->advertiserService->isSignedIn()) {
            return redirect()->action('Advertiser\DashboardController@index');
        }

        return $next($request);
    }
}
