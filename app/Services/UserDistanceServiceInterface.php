<?php
namespace App\Services;

interface UserDistanceServiceInterface extends BaseServiceInterface
{
    /**
     * @param int $campaignId
     * @return float
     */
    public function getDistanceData($campaignId);

    /**
     * @param array $trackingLogData
     * @return string
     */
    public function convertJSArrayStringDate($trackingLogData);
}
