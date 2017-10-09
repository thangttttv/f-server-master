<?php
namespace App\Services\Production;

use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\UserDistanceRepositoryInterface;
use App\Services\UserDistanceServiceInterface;
use Carbon\Carbon;

class UserDistanceService extends BaseService implements UserDistanceServiceInterface
{
    /** @var UserDistanceRepositoryInterface $userDistanceRepository */
    protected $userDistanceRepository;

    /** @var CampaignRepositoryInterface $campaignRepository */
    protected $campaignRepository;

    public function __construct(
        UserDistanceRepositoryInterface  $userDistanceRepository,
        CampaignRepositoryInterface $campaignRepository
    )
    {
        $this->campaignRepository = $campaignRepository;
        $this->userDistanceRepository = $userDistanceRepository;
    }

    public function getDistanceData($campaignId)
    {
        $userDistanceData = $this->userDistanceRepository->sumDistanceUser(
            $userId = 0, $campaignId, $areaId = 0, $date = '', $month='');

        return $userDistanceData;
    }

    public function convertJSArrayStringDate($trackingLogData)
    {
        $dateData = [];
        $valueData = [];
        foreach ($trackingLogData as $key => $log) {
            $dateData[] = Carbon::createFromFormat('Y-m-d', $log->date)->format('Y/m/d');
            $valueData[] = $log->totalEarning;
        }
        $graphData = ['dateData' => json_encode($dateData), 'valueData'=> json_encode($valueData)];

        return $graphData;
    }
}
