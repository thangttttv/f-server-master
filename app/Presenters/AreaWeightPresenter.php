<?php
namespace App\Presenters;

/**
 * @property \App\Models\AreaWeight $entity
 */
class AreaWeightPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    public function dayOfWeek()
    {
        $dayOfWeek = 'Unknown';
        $dayConfig = trans('config.day_of_week');
        if (array_key_exists($this->entity->day_of_week, $dayConfig)) {
            $dayOfWeek = $dayConfig[$this->entity->day_of_week];
        }

        return $dayOfWeek;
    }
}
