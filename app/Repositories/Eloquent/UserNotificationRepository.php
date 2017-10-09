<?php
namespace App\Repositories\Eloquent;

use App\Models\UserNotification;
use App\Repositories\UserNotificationRepositoryInterface;

class UserNotificationRepository extends NotificationRepository implements UserNotificationRepositoryInterface
{
    public function getBlankModel()
    {
        return new UserNotification();
    }
}
