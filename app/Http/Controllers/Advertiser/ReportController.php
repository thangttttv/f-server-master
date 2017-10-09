<?php

namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;

use App\Http\Requests\PaginationRequest;
use App\Models\CampaignUser;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CampaignUserRepositoryInterface;
use App\Repositories\UserDistanceRepositoryInterface;
use App\Services\AdvertiserServiceInterface;
use App\Services\UserDistanceServiceInterface;

class ReportController extends Controller
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

    public function __construct(
        CampaignRepositoryInterface $campaignRepository,
        AdvertiserServiceInterface $advertiserService,
        UserDistanceServiceInterface $userDistanceService,
        CampaignUserRepositoryInterface $campaignUserRepository,
        UserDistanceRepositoryInterface $userDistanceRepository
    )
    {
        $this->campaignRepository     = $campaignRepository;
        $this->userDistanceService    = $userDistanceService;
        $this->advertiserService      = $advertiserService;
        $this->campaignUserRepository = $campaignUserRepository;
        $this->userDistanceRepository = $userDistanceRepository;
    }

    /**
     * Display a listing of the resource.
     * @param \App\Http\Requests\PaginationRequest $request
     * @return \Response
     */
    public function index(PaginationRequest $request)
    {
        $advertiser  = $this->advertiserService->getUser();
        $offset      = $request->offset();
        $limit       = $request->limit();
        $countryCode = '';
        $cityId      = 0;
        $areaIds     = [];
        $name        = '';
        $count       = $this->campaignRepository->countEnabledWithConditions($advertiser->id, $countryCode, $cityId, $areaIds, $name, $runningOnly = false,  $status = '');
        $models      = $this->campaignRepository->getEnabledWithConditions(
            $advertiser->id, $countryCode, $cityId, $areaIds, $name, $runningOnly = false,  $status = '', 'id', 'desc', $offset, $limit);
        foreach ($models as $key => $model) {
            $models[$key]->userDistanceData = $this->userDistanceService->getDistanceData($model->id);
        }

        return view('pages.advertiser.report.index', [
            'models'       => $models,
            'count'        => $count,
            'offset'       => $offset,
            'limit'        => $limit,
            'advertiserId' => $advertiser->id,
            'countryCode'  => $countryCode,
            'cityId'       => $cityId,
            'areaIds'      => $areaIds,
            'name'         => $name,
            'params'       => [
                'advertiser_id' => $advertiser->id,
                'country_code'  => $countryCode,
                'city_id'       => $cityId,
                'area_ids'      => $areaIds,
                'name'          => $name,
            ],
            'menu'         => 'report',
            'baseUrl'      => action('Advertiser\ReportController@index'),
        ]);
    }

    public function detail($campaignId)
    {
        $campaign = $this->campaignRepository->find($campaignId);

        if (empty($campaign)) {
            abort(404);
        }
        $totalCampaignUser             = $this->campaignUserRepository->countEnabledWithConditions(
            $userId = 0, $campaignId, $status = '',
            $statusIncluded = [CampaignUser::TYPE_STATUS_FINISHED, CampaignUser::TYPE_STATUS_ONGOING], []);
        $trackingLogData               = $this->userDistanceRepository->sumDistanceUserGroupByDate(
            $userId = 0, $campaignId, $areaId = 0, $date = '', $month = '', 'date', 'asc');
        $campaign->userDistanceService = $this->userDistanceService->getDistanceData($campaign->id);
        $campaign->totalCampaignUser   = $totalCampaignUser;
        $graphData                     = $this->userDistanceService->convertJSArrayStringDate($trackingLogData);

        return view('pages.advertiser.report.detail', [
            'campaign'  => $campaign,
            'graphData' => $graphData,
        ]);
    }
}
