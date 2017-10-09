<?php
namespace App\Repositories;

interface CampaignUserRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @param int    $userId
     * @param int    $campaignId
     * @param string $status
     * @param array  $statusIncluded
     * @param array  $statusExcluded
     * @param string $order
     * @param string $direction
     * @param int    $offset
     * @param int    $limit
     *
     * @return \App\Models\Base[]|\Traversable|array
     */
    public function getEnabledWithConditions($userId, $campaignId, $status, $statusIncluded, $statusExcluded, $order, $direction, $offset, $limit);

    /**
     * @param int    $userId
     * @param int    $campaignId
     * @param string $status
     * @param array  $statusIncluded
     * @param array  $statusExcluded
     *
     * @return int
     */
    public function countEnabledWithConditions($userId, $campaignId, $status, $statusIncluded, $statusExcluded);

    /**
     * @param int    $userId
     * @param string $statusIncluded
     * @param array  $statusExcluded
     *
     * @return \App\Models\CampaignUser
     */
    public function findRunningCampaign($userId, $statusIncluded, $statusExcluded);

    /**
     * @param int    $userId
     * @param int    $campaignId
     * @param string $status
     * @param array  $statusIncluded
     * @param array  $statusExcluded
     * @return \App\Models\Base[]|\Traversable|array
     */
    public function AllEnabledWithConditions($userId, $campaignId, $status, $statusIncluded, $statusExcluded);
}
