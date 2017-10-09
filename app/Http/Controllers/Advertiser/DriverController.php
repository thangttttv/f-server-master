<?php
namespace App\Http\Controllers\Advertiser;


use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use App\Models\CampaignUser;
use App\Repositories\AreaRepositoryInterface;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CampaignUserRepositoryInterface;
use App\Repositories\CurrentLocationRepositoryInterface;
use App\Repositories\UserDistanceRepositoryInterface;
use App\Services\AdvertiserServiceInterface;
use App\Services\TrackingLogServiceInterface;
use App\Services\UserDistanceServiceInterface;

class DriverController extends Controller
{

    /** @var \App\Repositories\CampaignRepositoryInterface */
    protected $campaignRepository;

    /** @var \App\Services\AdvertiserServiceInterface */
    protected $advertiserService;

    /** @var \App\Services\UserDistanceServiceInterface */
    protected $userDistanceService;

    /** @var \App\Repositories\CampaignUserRepositoryInterface */
    protected $campaignUserRepository;

    /** @var \App\Repositories\UserDistanceRepositoryInterface */
    protected $userDistanceRepository;

    /** @var \App\Repositories\CurrentLocationRepositoryInterface */
    protected $currentLocationRepository;

    /** @var \App\Repositories\AreaRepositoryInterface */
    protected $areaRepository;

    /** @var \App\Repositories\TrackingLogServiceInterface */
    protected $trackingLogService;

    public function __construct(
        CampaignRepositoryInterface $campaignRepository,
        AdvertiserServiceInterface $advertiserService,
        UserDistanceServiceInterface $userDistanceService,
        CampaignUserRepositoryInterface $campaignUserRepository,
        UserDistanceRepositoryInterface $userDistanceRepository,
        CurrentLocationRepositoryInterface $currentLocationRepository,
        AreaRepositoryInterface $areaRepository,
        TrackingLogServiceInterface $trackingLogService
    )
    {
        $this->campaignRepository           = $campaignRepository;
        $this->userDistanceService          = $userDistanceService;
        $this->advertiserService            = $advertiserService;
        $this->campaignUserRepository       = $campaignUserRepository;
        $this->userDistanceRepository       = $userDistanceRepository;
        $this->currentLocationRepository    = $currentLocationRepository;
        $this->areaRepository               = $areaRepository;
        $this->trackingLogService           = $trackingLogService;
    }

    public function index(BaseRequest $request)
    {
        $advertiser = $this->advertiserService->getUser();
        $campaignId = $request->get('campaign_id', 0);

        if ($campaignId == 0) {
            $campaign = $this->campaignRepository->findByAdvertiserId($advertiser->id);
        } else {
            $campaign = $this->campaignRepository->findByIdAndAdvertiserId($campaignId, $advertiser->id);
        }
        $campaigns = $this->campaignRepository->allByAdvertiserId($advertiser->id);
        if (empty($campaign)) {
            return view('pages.advertiser.driver.blank', [
                'campaigns' => $campaigns,
            ]);
        }
        $campaignId = $campaign->id;
        $countCampaignUser = $this->campaignUserRepository->countEnabledWithConditions(
            $userId = 0, $campaignId, $status = '',
            $statusIncluded = [CampaignUser::TYPE_STATUS_FINISHED, CampaignUser::TYPE_STATUS_ONGOING], []);
        $userLocations = $this->trackingLogService->getCampaignUserLocations($campaignId);
        $areaLocationData = $this->trackingLogService->getCampaignAreaLocations($campaign);
        $totalCampaignUser = $countCampaignUser;
        $trackingLogData = $this->userDistanceRepository->sumDistanceUserGroupByDate(
            $userId = 0, $campaignId, $areaId = 0, $date = '', $month = '', 'date', 'asc');

        $campaign->userDistanceService = $this->userDistanceService->getDistanceData($campaignId);
        $campaign->totalCampaignUser = $totalCampaignUser;
        $graphData = $this->userDistanceService->convertJSArrayStringDate($trackingLogData);
        return view('pages.advertiser.driver.index', [
            'campaign'         => $campaign,
            'graphData'        => $graphData,
            'userLocations'    => $userLocations,
            'areaLocationData' => $areaLocationData,
            'campaigns'        => $campaigns,
        ]);
    }
}
