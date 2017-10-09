<?php
namespace App\Services\Production;

use App\Repositories\CurrentLocationRepositoryInterface;
use App\Repositories\OauthClientRepositoryInterface;
use App\Repositories\UserPasswordResetRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserServiceInterface;

class UserService extends AuthenticatableService implements UserServiceInterface
{
    /** @var string $resetEmailTitle */
    protected $resetEmailTitle = 'Reset Password';
    /** @var \App\Repositories\OauthClientRepositoryInterface */
    protected $oauthClientRepository;
    /** @var string $resetEmailTemplate */
    protected $resetEmailTemplate = 'emails.user.reset_password';

    /** @var CurrentLocationRepositoryInterface $currentLocationRepository */
    protected $currentLocationRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserPasswordResetRepositoryInterface $userPasswordResetRepository,
        OauthClientRepositoryInterface $oauthClientRepository,
        CurrentLocationRepositoryInterface $currentLocationRepository
    )
    {
        $this->authenticatableRepository = $userRepository;
        $this->passwordResettableRepository = $userPasswordResetRepository;
        $this->oauthClientRepository = $oauthClientRepository;
        $this->currentLocationRepository = $currentLocationRepository;
    }

    public function getGuardName()
    {
        return 'web';
    }

    public function updateCurrentLocation($lat, $lng, $campaignId)
    {
        $user = $this->getUser();
        $inputData = ['longitude' => $lng, 'latitude' => $lat,
                      'user_id'   => $user->id, 'campaign_id' => $campaignId];
        $currentLocation = $this->currentLocationRepository->findByUserIdAndCampaignId($user->id, $campaignId);
        if (empty($currentLocation)) {
            $currentLocation = $this->currentLocationRepository->create($inputData);
        } else {
            $currentLocation = $this->currentLocationRepository->update($currentLocation, $inputData);
        }

        return true;
    }

    public function updateLocationByTracking($journey, $campaignId)
    {
        $lat = null;
        $lng = null;
        $time = 0;
        foreach ($journey as $item) {
            if(floatval($item['time']) > $time){
                $time = floatval($item['time']);
                $lng = $item['lng'];
                $lat = $item['lat'];
            }
        }
        if($time > 0){
            $this->updateCurrentLocation($lat, $lng, $campaignId);
        }
        return true;
    }
}
