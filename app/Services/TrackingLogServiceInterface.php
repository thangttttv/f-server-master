<?php
namespace App\Services;

interface TrackingLogServiceInterface extends BaseServiceInterface
{
    /**
     * @param array $journey
     * @param array $areaLocations
     *
     * @return float
     */
    public function countDistance($journey, $areaLocations);

    /**
     * @return string
     */
    public function createId();

    /**
     * @param string $content
     *
     * @return string
     */
    public function hashTrajectory($content);

    /**
     * @param $distance
     * @param $areaId
     * @param $date
     * @param $journey
     * @return float
     */
    public function calculatorImpression($distance, $areaId, $date, $journey);

    /**
     * @param $campaign
     * @return array
     */
    public function getCampaignAreaLocations($campaign);

    /**
     * @param int $campaignId
     * @return array
     */
    public function getCampaignUserLocations($campaignId);
}
