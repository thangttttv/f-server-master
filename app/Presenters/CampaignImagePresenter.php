<?php
namespace App\Presenters;

/**
 * @property \App\Models\CampaignImage $entity
 */
class CampaignImagePresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    public function getWrappingImageUrl()
    {
        $imageUrl = \URLHelper::asset('img/no_image.jpg', 'common');
        if (!empty($this->entity->image)) {
            $imageUrl = $this->entity->image->url;
        }

        return $imageUrl;
    }
}
