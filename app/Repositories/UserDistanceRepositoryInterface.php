<?php
namespace App\Repositories;

interface UserDistanceRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @param int    $userId
     * @param int    $campaignId
     * @param int    $areaId
     * @param string $date
     * @param string $month
     * @return \App\Models\Base[]|\Traversable|array
     */
    public function sumDistanceUser($userId, $campaignId, $areaId = 0, $date = '', $month = '');

    /**
     * @param int    $userId
     * @param int    $campaignId
     * @param int    $areaId
     * @param string $date
     * @param string $month
     * @param string $order
     * @param string $direction
     * @return \App\Models\Base[]|\Traversable|array
     */
    public function sumDistanceUserGroupByDate($userId, $campaignId, $areaId = 0, $date = '', $month = '', $order, $direction);
}
