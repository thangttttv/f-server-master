<?php
namespace App\Presenters;

/**
 * @property \App\Models\Area $entity
 */
class AreaPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    public function country()
    {
        $countryName = 'Unknown';
        if(!empty($this->entity->country)){
            $countryName = $this->entity->country->name_en .'-'. $this->entity->country->name_local;
        }
        return $countryName;
    }

    public function city()
    {
        $cityName = 'Unknown';
        if(!empty($this->entity->city)){
            $cityName = $this->entity->city->name_en .'-'. $this->entity->city->name_local;
        }
        return $cityName;
    }
}
