<?php
namespace App\Http\Middleware\Advertiser;

//use App\Services\AdminUserNotificationServiceInterface;
use App\Services\AdvertiserServiceInterface;

class SetDefaultValues
{
    /** @var AdminUserServiceInterface */
    protected $advertiserService;

    /** @var AdminUserNotificationServiceInterface */
//    protected $adminUserNotificationService;

    /**
     * Create a new filter instance.
     *
     * @param AdminUserServiceInterface             $adminUserService
     * @param AdminUserNotificationServiceInterface $adminUserNotificationService
     */
    public function __construct(
        AdvertiserServiceInterface $advertiserService
//        AdminUserNotificationServiceInterface $adminUserNotificationService
    ) {
        $this->advertiserService             = $advertiserService;
//        $this->adminUserNotificationService = $adminUserNotificationService;
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
        $user = $this->advertiserService->getUser();
        \View::share('authAdvertiser', $user);
        \View::share('menu', '');

//        if (!empty($user)) {
//            $notificationCount = $this->adminUserNotificationService->getUnreadNotificationCount($user);
//            $notifications     = $this->adminUserNotificationService->getNotifications($user, 0, 10);
//        } else {
//            $notificationCount = 0;
//            $notifications     = 0;
//        }
//
//        \View::share('unreadNotificationCount', $notificationCount);
//        \View::share('notifications', $notifications);

        return $next($request);
    }
}
