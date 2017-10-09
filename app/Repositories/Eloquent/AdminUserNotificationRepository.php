<?php
namespace App\Repositories\Eloquent;

use App\Models\AdminUserNotification;
use App\Repositories\AdminUserNotificationRepositoryInterface;

class AdminUserNotificationRepository extends NotificationRepository implements AdminUserNotificationRepositoryInterface
{
    public function getBlankModel()
    {
        return new AdminUserNotification();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
