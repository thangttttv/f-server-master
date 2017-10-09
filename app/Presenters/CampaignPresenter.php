<?php
namespace App\Presenters;

/**
 * @property \App\Models\Campaign $entity
 */
class CampaignPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    public function brandImageUrl()
    {
        $imageUrl = \URLHelper::asset('img/no_image.jpg', 'common');
        if ($this->entity->brand_image_id != 0) {
            if (!empty($this->entity->brandImage)) {
                $imageUrl = $this->entity->brandImage->url;
            }
        }

        return $imageUrl;
    }

    public function areas()
    {
        $areas      = '';
        $areasArray = $this->entity->areas;
        if (sizeof($areasArray)) {
            foreach ($areasArray as $key => $value) {
                $areas .= $value->name_local;
                if ($key < sizeof($areasArray)-1) {
                    $areas .= ', ';
                }
            }
        }

        return $areas;
    }

    public function advertiserName()
    {
        $advertiserName = 'Unknown';

        if ($this->entity->advertiser_id != 0) {
            if (!empty($this->entity->advertiser)) {
                $advertiserName = $this->entity->advertiser->name;
            }
        }

        return $advertiserName;
    }

    public function endDate()
    {
        $endDate = 'Unknown';

        if (!empty($this->entity->end_date)) {
            $endDate = $this->entity->end_date;
        }

        return $endDate;
    }

    public function minimumRate($wrappingImages)
    {
        $value = 0;
        if (count($wrappingImages) > 0) {
            $value = $wrappingImages[0]['baseRevenue'];
        }
        foreach ($wrappingImages as $wrappingImage) {
            if ($wrappingImage['baseRevenue'] < $value) {
                $value = $wrappingImage['baseRevenue'];
            }
        }

        return $value;
    }

    public function maximumRate($wrappingImages)
    {
        $value = 0;
        if (count($wrappingImages) > 0) {
            $value = $wrappingImages[0]['baseRevenue'];
        }
        foreach ($wrappingImages as $wrappingImage) {
            if ($wrappingImage['baseRevenue'] > $value) {
                $value = $wrappingImage['baseRevenue'];
            }
        }

        return $value;
    }

    public function country()
    {
        $countryName = 'Unknown';
        if(!empty($this->entity->country)){
            $countryName = $this->entity->country->name_en;
        }

        return $countryName;
    }
}
