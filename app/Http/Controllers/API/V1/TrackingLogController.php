<?php
namespace App\Http\Controllers\API\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\TrackingLogRequest;
use App\Http\Responses\API\V1\TrackingData;
use App\Models\CampaignUser;
use App\Repositories\AreaImpressionRepositoryInterface;
use App\Repositories\CampaignImageRepositoryInterface;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CampaignUserRepositoryInterface;
use App\Repositories\DynamoDB\TrackingLogRepositoryInterface as DynamoDBTrackingLogRepositoryInterface;
use App\Repositories\TrackingLogRepositoryInterface;
use App\Repositories\UserDistanceRepositoryInterface;
use App\Services\APIUserServiceInterface;
use App\Services\CampaignImageServiceInterface;
use App\Services\TrackingLogServiceInterface;

class TrackingLogController extends Controller
{
    /** @var \App\Repositories\TrackingLogRepositoryInterface $trackingLogRepository */
    protected $trackingLogRepository;

    /** @var \App\Repositories\CampaignUserRepositoryInterface $campaignUserRepository */
    protected $campaignUserRepository;

    /** @var \App\Repositories\CampaignRepositoryInterface $campaignRepository */
    protected $campaignRepository;

    /** @var \App\Services\APIUserServiceInterface $userService */
    protected $userService;

    /** @var \App\Services\TrackingLogServiceInterface $trackingLogService */
    protected $trackingLogService;

    /** @var \App\Repositories\UserDistanceRepositoryInterface $userDistanceRepository */
    protected $userDistanceRepository;

    /** @var \App\Repositories\AreaImpressionRepositoryInterface $AreaImpressionRepository */
    protected $AreaImpressionRepository;

    /** @var \App\Repositories\CampaignImageRepositoryInterface $campaignImageRepository */
    protected $campaignImageRepository;

    /** @var \App\Services\CampaignImageServiceInterface $campaignImageService */
    protected $campaignImageService;

    /** @var \App\Repositories\DynamoDB\TrackingLogRepositoryInterface $dynamoDBTrackingLogRepository */
    protected $dynamoDBTrackingLogRepository;

    public function __construct(
        TrackingLogRepositoryInterface $trackingLogRepository,
        APIUserServiceInterface $userService,
        TrackingLogServiceInterface $trackingLogService,
        CampaignUserRepositoryInterface $campaignUserRepository,
        CampaignRepositoryInterface $campaignRepository,
        UserDistanceRepositoryInterface $userDistanceRepository,
        AreaImpressionRepositoryInterface $AreaImpressionRepository,
        CampaignImageRepositoryInterface $campaignImageRepository,
        CampaignImageServiceInterface $campaignImageService,
        DynamoDBTrackingLogRepositoryInterface $dynamoDBTrackingLogRepository
    ) {
        $this->trackingLogRepository             = $trackingLogRepository;
        $this->userService                       = $userService;
        $this->trackingLogService                = $trackingLogService;
        $this->campaignUserRepository            = $campaignUserRepository;
        $this->campaignRepository                = $campaignRepository;
        $this->userDistanceRepository            = $userDistanceRepository;
        $this->AreaImpressionRepository          = $AreaImpressionRepository;
        $this->campaignImageRepository           = $campaignImageRepository;
        $this->campaignImageService              = $campaignImageService;
        $this->dynamoDBTrackingLogRepository     = $dynamoDBTrackingLogRepository;
    }

    public function postTrackingLog(TrackingLogRequest $request)
    {
        $user  = $this->userService->getUser();
        $input = $request->only(['date', 'trajectory',
            'campaign_id', 'id', 'trajectory_hash', ]);
        $input['user_id'] = $user->id;
        $hashTrajectory = $this->trackingLogService->hashTrajectory(json_encode($input['trajectory']));
        if(strtolower($input['trajectory_hash']) != strtolower($hashTrajectory)){
            throw new APIErrorException('wrongParameter', 'Wrong input', []);
        }
        $dynamoTrackingModel = $this->dynamoDBTrackingLogRepository->find(
            ['id'=> strval($input['id']), 'trajectory_hash' => strval($input['trajectory_hash'])]);
        if(!empty($dynamoTrackingModel)){
            throw new APIErrorException('trackingPostDuplicate', 'Tracking logs duplicate', []);
        }
        $campaign = $this->campaignRepository->find($input['campaign_id']);
        if (empty($campaign)) {
            throw new APIErrorException('notFound', 'Campaign not found', []);
        }
        $campaignUser = $this->campaignUserRepository->findByCampaignIdAndUserIdAndStatus(
            $campaign->id, $user->id, CampaignUser::TYPE_STATUS_ONGOING);
        if (empty($campaignUser)) {
            throw new APIErrorException('notFound', 'Campaign not found', []);
        }
        $inputTrackingLogDynamoDB               = $input;
        $inputTrackingLogDynamoDB['trajectory'] = json_encode($input['trajectory']);
        $trackingLog                            = $this->dynamoDBTrackingLogRepository->create($inputTrackingLogDynamoDB);
        if (empty($trackingLog)) {
            throw new APIErrorException('severError', 'Create tracking log failed', []);
        }

        if (count($campaign->areas) > 0) {
            foreach ($campaign->areas as $key => $area) {
                $distance     = $this->trackingLogService->countDistance($input['trajectory'], $area->location_data);
                $distance     = round($distance, 2);
                $totalCost    = $this->campaignImageService->costCalculator($distance, $campaignUser->wrapping_image_id);
                $userDistance = $this->userDistanceRepository->findByDateAndUserIdAndCampaignIdAndAreaId(
                    $input['date'], $user->id, $campaign->id, $area->id);
                $totalImpression = $this->trackingLogService->calculatorImpression(
                    $distance, $area->id, $input['date'], $input['trajectory']);
                $userDistanceData = ['user_id' => $user->id, 'campaign_id' => $campaign->id,
                    'area_id'                  => $area->id, 'distance' => $distance,
                    'date'                     => $input['date'], 'total_cost' => $totalCost, 'total_impression' =>$totalImpression,
                ];
                if (empty($userDistance)) {
                    $userDistance = $this->userDistanceRepository->create($userDistanceData);
                } else {
                    $userDistanceData['distance']         = $userDistance->distance + $distance;
                    $userDistanceData['total_cost']       = $userDistance->total_cost + $totalCost;
                    $userDistanceData['total_impression'] = $userDistance->total_impression + $totalImpression;
                    $userDistance                         = $this->userDistanceRepository->update($userDistance, $userDistanceData);
                }
            }
        }
        $this->userService->updateLocationByTracking($input['trajectory'], $campaign->id);
        $sumByUser = $this->userDistanceRepository->sumDistanceUser($user->id, $campaign->id, $areaId = 0, $input['date'], $month='');

        return TrackingData::updateWithModel($sumByUser)->response();
    }
}
