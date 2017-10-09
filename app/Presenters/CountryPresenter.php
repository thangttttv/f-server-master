<?php
namespace App\Presenters;

/**
 * @property \App\Models\Country $entity
 */
class CountryPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = ['flag_image'];

    public function getFlagImageUrl()
    {
        $imageUrl = null;
        if ($this->entity->flag_image_id != 0) {
            if (!empty($this->entity->flagImage)) {
                $imageUrl = $this->entity->flagImage->url;
            }
        }

        return $imageUrl;
    }
}
