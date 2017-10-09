<?php
namespace App\Services;

/**
 * Interface UserServiceInterface.
 *
 * @method \App\Models\User getUser()
 */
interface UserServiceInterface extends AuthenticatableServiceInterface
{
    /**
     * @param string $lat
     * @param string $lng
     * @param int    $campaignId
     * @return mixed
     */
    public function updateCurrentLocation($lat, $lng, $campaignId);

    /**
     * @param array $journey
     * @param int $campaignId
     * @return mixed
     */
    public function updateLocationByTracking($journey, $campaignId);
}
