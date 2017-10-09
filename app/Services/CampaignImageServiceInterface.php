<?php
namespace App\Services;

interface CampaignImageServiceInterface extends BaseServiceInterface
{
    public function costCalculator($distance, $campaignImageId);
}
