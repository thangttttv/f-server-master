<?php
namespace App\Presenters;

/**
 * @property \App\Models\AdvertiserNotification $entity
 */
class AdvertiserNotificationPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    public function name()
    {

        if ($this->entity->advertiser_id == 0) {
            return 'Broadcast';
        }

        $user = $this->entity->advertiser;
        if (empty($user)) {
            return 'Unknown';
        }

        return $user->name;
    }
}
