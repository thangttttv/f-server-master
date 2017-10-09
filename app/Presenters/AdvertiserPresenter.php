<?php
namespace App\Presenters;

/**
 * @property \App\Models\Advertiser $entity
 */
class AdvertiserPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = ['profile_image'];

    public function getProfileImageUrl()
    {
        $imageUrl = null;
        if ($this->entity->profile_image_id != 0) {
            if (!empty($this->entity->profileImage)) {
                $imageUrl = $this->entity->profileImage->url;
            }
        }

        return $imageUrl;
    }
}
