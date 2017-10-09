<?php
namespace App\Repositories;

interface CampaignRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @param int     $advertiserId
     * @param string  $countryCode
     * @param int     $cityId
     * @param array   $areaIds
     * @param array   $name
     * @param boolean $runningOnly
     * @param string  $status
     * @param string  $order
     * @param string  $direction
     * @param integer $offset
     * @param integer $limit
     *
     * @return \App\Models\Base[]|\Traversable|array
     */
    public function getEnabledWithConditions($advertiserId, $countryCode, $cityId, $areaIds, $name,
                                             $runningOnly = false, $status = '', $order = 'id', $direction = 'asc', $offset = 0, $limit = 10);

    /**
     * @param integer $advertiserId
     * @param string  $countryCode
     * @param integer $cityId
     * @param array   $areaIds
     * @param array   $name
     * @param boolean $runningOnly
     * @param string  $status
     *
     * @return integer
     */
    public function countEnabledWithConditions($advertiserId, $countryCode, $cityId, $areaIds, $name, $runningOnly = false,  $status = '');
}
