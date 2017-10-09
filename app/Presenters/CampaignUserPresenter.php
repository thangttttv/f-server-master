<?php
namespace App\Presenters;

/**
 * @property \App\Models\CampaignUser $entity
 */
class CampaignUserPresenter extends BasePresenter
{
    protected $multilingualFields = [];

    protected $imageFields = [];

    public function userName()
    {
        $value = 'unknown';
        if (!empty($this->entity->user)) {
            $value = $this->entity->user->first_name.' '.$this->entity->user->last_name;
        }

        return $value;
    }

    public function campaignName()
    {
        $value = 'unknown';
        if (!empty($this->entity->campaign)) {
            $value = $this->entity->campaign->name;
        }

        return $value;
    }
}
