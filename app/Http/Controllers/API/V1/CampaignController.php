<?php
namespace App\Http\Controllers\API\V1;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\CampaignApplyRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Responses\API\V1\Campaign;
use App\Http\Responses\API\V1\Campaigns;
use App\Http\Responses\API\V1\CampaignUser as CampaignApply;
use App\Http\Responses\API\V1\Status;
use App\Http\Responses\API\V1\TrackingData;
use App\Models\CampaignUser;
use App\Repositories\AdvertiserRepositoryInterface;
use App\Repositories\CampaignImageRepositoryInterface;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CampaignUserRepositoryInterface;
use App\Repositories\UserDistanceRepositoryInterface;
use App\Services\APIUserServiceInterface;
use Carbon\Carbon;

class CampaignController extends Controller
{
    /** @var \App\Repositories\CampaignRepositoryInterface $campaignRepository */
    protected $campaignRepository;

    /** @var \App\Repositories\AdvertiserRepositoryInterface advertiserRepository */
    protected $advertiserRepository;

    /** @var \App\Services\APIUserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\CampaignUserRepositoryInterface $campaignUserRepository */
    protected $campaignUserRepository;

    /** @var \App\Repositories\CampaignImageRepositoryInterface $campaignImageRepository */
    protected $campaignImageRepository;

    /** @var \App\Repositories\UserDistanceRepositoryInterface $userDistanceRepository */
    protected $userDistanceRepository;

    public function __construct(
        CampaignRepositoryInterface $campaignRepository,
        AdvertiserRepositoryInterface $advertiserRepository,
        APIUserServiceInterface $userService,
        CampaignUserRepositoryInterface $campaignUserRepository,
        CampaignImageRepositoryInterface $campaignImageRepository,
        UserDistanceRepositoryInterface $userDistanceRepository
    )
    {
        $this->campaignRepository = $campaignRepository;
        $this->advertiserRepository = $advertiserRepository;
        $this->userService = $userService;
        $this->campaignUserRepository = $campaignUserRepository;
        $this->campaignImageRepository = $campaignImageRepository;
        $this->userDistanceRepository = $userDistanceRepository;
    }

    public function getCampaigns(PaginationRequest $request)
    {
        $countryCode = $request->get('country_code', '');
        $cityId      = $request->get('city_id', 0);
        $areaIds     = $request->get('area_id', []);
        $name        = $request->get('name', '');
        $order       = $request->get('order', 'name');
        $direction   = $request->get('direction', 'asc');
        $runningOnly = true;
        $offset = $request->offset();
        $limit = $request->limit();
        $count = $this->campaignRepository->countEnabledWithConditions(
            $advertiserId = 0, $countryCode, $cityId, $areaIds, $name, $runningOnly, $status = '');
        $campaigns = $this->campaignRepository->getEnabledWithConditions(
            $advertiserId = 0, $countryCode, $cityId, $areaIds, $name, $runningOnly, $status = '',
            $order, $direction, $offset, $limit);
        $hasNext = \PaginationHelper::hasNext($count, $offset, $limit);

        return Campaigns::updateListWithModel($campaigns, $offset, $limit, $hasNext)->response();
    }

    public function campaignDetail($id)
    {
        $campaign = $this->campaignRepository->find($id);
        if (empty($id) || empty($campaign)) {
            Status::error('notFound', 'Page not found', []);
        }

        return Campaign::updateWithModel($campaign)->response();
    }

    public function applyCampaign($campaignId, CampaignApplyRequest $request)
    {
        $user = $this->userService->getUser();
        if (empty($user->driverLicenceImage)) {
            throw new APIErrorException('driverLicenceEmpty', '', []);
        }
        if (empty($user->car)) {
            throw new APIErrorException('carEmpty', '', []);
        }
        $campaign = $this->campaignRepository->find($campaignId);
        if (empty($campaign)) {
            throw new APIErrorException('notFound', 'Campaign not found', []);
        }
        $campaignImage = $this->campaignImageRepository->find($request->get('campaign_image_id'));
        if (empty($campaignImage)) {
            throw new APIErrorException('notFound', 'Campaign image not found', []);
        }
        $userId = $user->id;
        $statusIncluded = [CampaignUser::TYPE_STATUS_PENDING, CampaignUser::TYPE_STATUS_ONGOING];
        $statusExcluded = [];
        $campaignRunning = $this->campaignUserRepository->findRunningCampaign($userId, $statusIncluded, $statusExcluded);
        if (!empty($campaignRunning)) {
            throw new APIErrorException('campaignAlreadyApply', '', []);
        }
        $model = $this->campaignUserRepository->create(
            ['user_id' => $user->id, 'campaign_id' => $campaign->id,
             'status'  => CampaignUser::TYPE_STATUS_PENDING, 'wrapping_image_id' => $campaignImage->id,]);

        return CampaignApply::updateWithModel($model)->response();
    }

    public function cancelCampaign($id)
    {
        $user = $this->userService->getUser();
        $campaign = $this->campaignUserRepository->find($id);
        if (empty($campaign)) {
            throw new APIErrorException('notFound', 'Campaign not found', []);
        }
        $statusIncluded = [CampaignUser::TYPE_STATUS_PENDING];
        $statusExcluded = [];
        $runningCampaign = $this->campaignUserRepository->findRunningCampaign($user->id, $statusIncluded, $statusExcluded);
        if (!empty($runningCampaign) && $user->id != $runningCampaign->user_id) {
            throw new APIErrorException('cancelCampaignPermissionDenied', 'Permission denied', []);
        }
        $model = $this->campaignUserRepository->update($runningCampaign,
            ['status' => CampaignUser::TYPE_STATUS_CANCELED, 'finished_at' => \DateTimeHelper::now()]);

        return CampaignApply::updateWithModel($model)->response();
    }

    public function getMyCampaign()
    {
        $user = $this->userService->getUser();
        $statusIncluded = [CampaignUser::TYPE_STATUS_PENDING, CampaignUser::TYPE_STATUS_ONGOING];
        $statusExcluded = [];
        $runningCampaign = $this->campaignUserRepository->findRunningCampaign($user->id, $statusIncluded, $statusExcluded);

        return CampaignApply::updateWithModel($runningCampaign)->response();
    }

    public function countDistance($date)
    {
        $dateCreate = null;
        $user = $this->userService->getUser();
        $statusIncluded = [CampaignUser::TYPE_STATUS_ONGOING];
        $statusExcluded = [];
        $dateInput = null;
        $monthInput = null;
        try {
            $dateCreate = Carbon::createFromFormat('Y-m', $date);
            $monthInput = $dateCreate->format('Y-m');
        } catch (\Exception $e) {
            try {
                $dateCreate = Carbon::createFromFormat('Y-m-d', $date);
                $dateInput = $dateCreate->format('Y-m-d');

            } catch (\Exception $e) {
                throw new APIErrorException('wrongParameter', '', []);
            }
        }
        if (!empty($monthInput)) {
            $sumByUser = $this->countDistanceByMonth($monthInput, $user, $statusIncluded, $statusExcluded);
        } else {
            $sumByUser = $this->countDistanceByDate($dateInput, $user, $statusIncluded, $statusExcluded);
        }
        return TrackingData::updateWithModel($sumByUser)->response();
    }

    private function countDistanceByMonth($month, $user, $statusIncluded, $statusExcluded)
    {
        $runningCampaign = $this->campaignUserRepository->findRunningCampaign($user->id, $statusIncluded, $statusExcluded);
        if (empty($runningCampaign)) {
            throw new APIErrorException('notFound', 'You have no campaign', []);
        }
        $sumByUser = $this->userDistanceRepository->sumDistanceUser($user->id, $runningCampaign->campaign_id, $areaId = 0, $date = '', $month);

        return $sumByUser;
    }

    private function countDistanceByDate($date, $user, $statusIncluded, $statusExcluded)
    {
        $runningCampaign = $this->campaignUserRepository->findRunningCampaign($user->id, $statusIncluded, $statusExcluded);
        if (empty($runningCampaign)) {
            throw new APIErrorException('notFound', 'You have no campaign', []);
        }
        $sumByUser = $this->userDistanceRepository->sumDistanceUser($user->id, $runningCampaign->campaign_id, $areaId = 0, $date, $month = '');

        return $sumByUser;
    }
}
