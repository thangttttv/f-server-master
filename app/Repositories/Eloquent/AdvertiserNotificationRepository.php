<?php
namespace App\Repositories\Eloquent;

use App\Models\AdvertiserNotification;
use App\Repositories\AdvertiserNotificationRepositoryInterface;

class AdvertiserNotificationRepository extends NotificationRepository implements AdvertiserNotificationRepositoryInterface
{
    public function getBlankModel()
    {
        return new AdvertiserNotification();
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
