<?php
namespace App\Http\Middleware\Advertiser;

use App\Services\AdvertiserServiceInterface;
use Closure;

class Authenticate
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
    public function handle($request, Closure $next)
    {
        if (!$this->advertiserService->isSignedIn()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return \RedirectHelper::guest(action('Advertiser\AuthController@getSignIn'), $this->advertiserService->getGuardName());
            }
        }
        view()->share('advertiserUser', $this->advertiserService->getUser());

        return $next($request);
    }
}
