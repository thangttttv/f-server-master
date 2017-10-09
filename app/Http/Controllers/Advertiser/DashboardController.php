<?php

namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;
use App\Http\Requests\Advertiser\CampaignRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\AdvertiserRepositoryInterface;
use App\Repositories\AreaRepositoryInterface;
use App\Repositories\CampaignAreaRepositoryInterface;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Repositories\UserDistanceRepositoryInterface;
use App\Services\AdvertiserServiceInterface;
use App\Services\FileUploadServiceInterface;
use App\Services\ImageServiceInterface;
use App\Services\UserDistanceServiceInterface;

class DashboardController extends Controller
{
    /** @var \App\Repositories\CampaignRepositoryInterface */
    protected $campaignRepository;

    /** @var \App\Repositories\AdvertiserRepositoryInterface */
    protected $advertiserRepository;

    /** @var \App\Repositories\CityRepositoryInterface */
    protected $cityRepository;

    /** @var \App\Repositories\CountryRepositoryInterface */
    protected $countryRepository;

    /** @var FileUploadServiceInterface $fileUploadService */
    protected $fileUploadService;

    /** @var ImageRepositoryInterface $imageRepository */
    protected $imageRepository;

    /** @var ImageServiceInterface $imageService */
    protected $imageService;

    /** @var AreaRepositoryInterface $areaRepository */
    protected $areaRepository;

    /** @var CampaignAreaRepositoryInterface $campaignAreaRepository */
    protected $campaignAreaRepository;

    /** @var AdvertiserServiceInterface $advertiserService */
    protected $advertiserService;

    /** @var UserDistanceServiceInterface $userDistanceService */
    protected $userDistanceService;

    public function __construct(
        CampaignRepositoryInterface $campaignRepository,
        AdvertiserRepositoryInterface $advertiserRepository,
        CityRepositoryInterface $cityRepository,
        CountryRepositoryInterface $countryRepository,
        FileUploadServiceInterface $fileUploadService,
        ImageRepositoryInterface $imageRepository,
        ImageServiceInterface $imageService,
        AreaRepositoryInterface $areaRepository,
        CampaignAreaRepositoryInterface $campaignAreaRepository,
        AdvertiserServiceInterface $advertiserService,
        UserDistanceServiceInterface $userDistanceService
    )
    {
        $this->campaignRepository     = $campaignRepository;
        $this->advertiserRepository   = $advertiserRepository;
        $this->cityRepository         = $cityRepository;
        $this->countryRepository      = $countryRepository;
        $this->fileUploadService      = $fileUploadService;
        $this->imageRepository        = $imageRepository;
        $this->imageService           = $imageService;
        $this->areaRepository         = $areaRepository;
        $this->campaignAreaRepository = $campaignAreaRepository;
        $this->advertiserService      = $advertiserService;
        $this->userDistanceService    = $userDistanceService;
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
            $advertiser->id, $countryCode, $cityId, $areaIds, $name, $runningOnly = false, $status = '', 'id', 'desc', $offset, $limit);
        foreach ($models as $key => $model) {
            $models[$key]->userDistanceData = $this->userDistanceService->getDistanceData($model->id);
        }

        return view('pages.advertiser.dashboard.index', [
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
            'menu'         => 'dashboard',
            'baseUrl'      => action('Advertiser\DashboardController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Response
     */
    public function create()
    {
        return view('pages.advertiser.dashboard.create', [
            'isNew' => true,
            'menu'  => 'dashboard',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  $request
     * @return \Response
     */
    public function store(CampaignRequest $request)
    {
        $input = $request->only(['name', 'budget', 'date']);
        $input['status'] = 'pending';
        $model = $this->campaignRepository->create($input);
        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Advertiser\DashboardController@index');
    }

    /**
     * Display the specified resource.
     * @param int $id
     * @return \Response
     */
    public function show($id)
    {
        $model = $this->campaignRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

//        print_r($model->areas);exit();
        return view('pages.advertiser.dashboard.create', [
            'isNew'       => false,
            'countries'   => $this->countryRepository->all('order', 'asc'),
            'cities'      => $this->cityRepository->all('order', 'asc'),
            'advertisers' => $this->advertiserRepository->all('name', 'asc'),
            'areas'       => $this->areaRepository->all('order', 'asc'),
            'campaign'    => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return \Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     * @param int $id
     * @param     $request
     * @return \Response
     */
    public function update($id, CampaignRequest $request)
    {
        /** @var \App\Models\Campaign $model */
        $model = $this->campaignRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only([
                                    'name', 'description', 'minimum_revenue',
                                    'maximum_revenue', 'budget_currency_code', 'budget',
                                    'start_date', 'end_date', 'country_code', 'advertiser_id', 'city_id',
                                ]);

        $this->campaignRepository->update($model, $input);
        if ($request->hasFile('brand_image')) {
            $file      = $request->file('brand_image');
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileUploadService->upload('campaign-image', $path, $mediaType, [
                'entityType' => 'campaign',
                'entityId'   => $model->id,
                'title'      => $request->input('name', ''),
            ]);

            if (!empty($image)) {
                $this->campaignRepository->update($model, ['brand_image_id' => $image->id]);
            }
        }
        $areas = $request->get('area_id', []);
        $this->campaignAreaRepository->updateList($model->id, $areas);

        return redirect()->action('Advertiser\DashboardController@show', [$id])
                         ->with('message-success', trans('admin.messages.general.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\Campaign $model */
        $model = $this->campaignRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->campaignRepository->delete($model);

        return redirect()->action('Advertiser\DashboardController@index')
                         ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
