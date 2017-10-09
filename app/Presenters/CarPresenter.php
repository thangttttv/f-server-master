<?php
namespace App\Presenters;

/**
 * @property \App\Models\Car $entity
 */
class CarPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = ['profile_image'];

    public function getCarImageUrl()
    {
        $imageUrl = null;
        if ($this->entity->image_id != 0) {
            if (!empty($this->entity->carImage)) {
                $imageUrl = $this->entity->carImage->url;
            }
        }

        return $imageUrl;
    }
}
