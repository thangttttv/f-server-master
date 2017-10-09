<?php
namespace App\Presenters;

/**
 * @property \App\Models\User $entity
 */
class UserPresenter extends BasePresenter
{
    public function userName()
    {
        $value = 'Unknown';
        if (!empty($this->entity->first_name) || !empty($this->entity->last_name)) {
            $value = $this->entity->first_name.' '.$this->entity->last_name;
        }

        return $value;
    }

    public function driverLicenceImage()
    {
        $imageUrl = '';
        if (!empty($this->entity->driverLicenceImage)) {
            $imageUrl = $this->entity->driverLicenceImage->url;
        }

        return $imageUrl;
    }

    public function profileImage()
    {
        $imageUrl = \URLHelper::asset('img/avatar-user.png', 'common');
        if (!empty($this->entity->profileImage)) {
            $imageUrl = $this->entity->profileImage->url;
        }

        return $imageUrl;
    }

    public function carImage()
    {
        $imageUrl = \URLHelper::asset('img/no_image.jpg', 'common');
        if (!empty($this->entity->car)) {
            $imageUrl = $this->entity->car->present()->getCarImageUrl();
        }

        return $imageUrl;
    }
}
