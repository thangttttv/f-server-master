<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CampaignRequest;
use App\Http\Requests\BaseRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\Campaign;
use App\Repositories\AdvertiserRepositoryInterface;
use App\Repositories\AreaRepositoryInterface;
use App\Repositories\CampaignAreaRepositoryInterface;
use App\Repositories\CampaignImageRepositoryInterface;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Services\FileUploadServiceInterface;
use App\Services\ImageServiceInterface;
use App\Services\UserDistanceServiceInterface;

class CampaignController extends Controller
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

    /** @var UserDistanceServiceInterface $userDistanceService */
    protected $userDistanceService;

    /** @var CampaignImageRepositoryInterface $campaignImageRepository */
    protected $campaignImageRepository;

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
        UserDistanceServiceInterface $userDistanceService,
        CampaignImageRepositoryInterface $campaignImageRepository
    )
    {
        $this->campaignRepository = $campaignRepository;
        $this->advertiserRepository = $advertiserRepository;
        $this->cityRepository = $cityRepository;
        $this->countryRepository = $countryRepository;
        $this->fileUploadService = $fileUploadService;
        $this->imageRepository = $imageRepository;
        $this->imageService = $imageService;
        $this->areaRepository = $areaRepository;
        $this->campaignAreaRepository = $campaignAreaRepository;
        $this->userDistanceService = $userDistanceService;
        $this->campaignImageRepository = $campaignImageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\PaginationRequest $request
     *
     * @return \Response
     */
    public function index(PaginationRequest $request)
    {
        $offset = $request->offset();
        $limit = $request->limit();
        $advertisers = $this->advertiserRepository->all('name', 'asc');
        $countries = $this->countryRepository->all('name_en', 'asc');
        $cities = $this->cityRepository->all('name_en', 'asc');
        $status = $request->get('status', '');
        $advertiserId = $request->get('advertiser_id', 0);
        $cityId = $request->get('city_id', 0);
        $countryCode = $request->get('country_code', '');
        $name = $request->get('name', '');
        $count = $this->campaignRepository->countEnabledWithConditions($advertiserId, $countryCode, $cityId, $areaIds = [], $name, $runningOnly = false, $status);
        $models = $this->campaignRepository->getEnabledWithConditions($advertiserId, $countryCode, $cityId, $areaIds = [], $name, $runningOnly = false, $status, 'id', 'desc', $offset, $limit);
        foreach ($models as $key => $model) {
            $models[$key]->userDistanceData = $this->userDistanceService->getDistanceData($model->id);
        }

        return view('pages.admin.campaigns.index', [
            'models'       => $models,
            'count'        => $count,
            'offset'       => $offset,
            'limit'        => $limit,
            'advertisers'  => $advertisers,
            'countries'    => $countries,
            'cities'       => $cities,
            'statuses'     => [Campaign::STATUS_PENDING, Campaign::STATUS_ONGOING,
                Campaign::STATUS_CANCELED, Campaign::STATUS_FINISHED],
            'status'       => $status,
            'advertiserId' => $advertiserId,
            'cityId'       => $cityId,
            'countryCode'  => $countryCode,
            'name'         => $name,
            'params'       => [
                'status'        => $status,
                'advertiser_id' => $advertiserId,
                'city_id'       => $cityId,
                'country_code'  => $countryCode,
                'name'          => $name,
            ],
            'baseUrl'      => action('Admin\CampaignController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.campaigns.edit', [
            'isNew'         => true,
            'currencyList'  => config('locale.currency_code'),
            'countries'     => $this->countryRepository->all('order', 'asc'),
            'cities'        => $this->cityRepository->all('order', 'asc'),
            'advertisers'   => $this->advertiserRepository->all('name', 'asc'),
            'areas'         => $this->areaRepository->all('order', 'asc'),
            'campaign'      => $this->campaignRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(CampaignRequest $request)
    {
        $input = $request->only(['name', 'description',
            'minimum_revenue', 'maximum_revenue', 'budget_currency_code',
            'budget', 'start_date', 'end_date', 'country_code',
            'advertiser_id', 'city_id',]);
        $input['minimum_revenue'] = $request->get('minimum_revenue', 0);
        $input['maximum_revenue'] = $request->get('maximum_revenue', 0);
        $input['status'] = Campaign::STATUS_PENDING;
        $model = $this->campaignRepository->create($input);
        if ($request->hasFile('brand_image')) {
            $file = $request->file('brand_image');
            $mediaType = $file->getClientMimeType();
            $path = $file->getPathname();
            $image = $this->fileUploadService->upload('campaign-image', $path, $mediaType, [
                'entityType' => 'campaign',
                'entityId'   => $model->id,
                'title'      => $request->input('name', ''),
            ]);

            if (!empty($image)) {
                $this->campaignRepository->update($model, [
                    'brand_image_id' => $image->id,
                ]);
            }
        }
        $areas = $request->get('area_id', []);
        $this->campaignAreaRepository->updateList($model->id, $areas);
        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\CampaignController@index')
            ->with('message-success', trans('admin.messages.general.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Response
     */
    public function show($id)
    {
        $model = $this->campaignRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.campaigns.edit', [
            'isNew'         => false,
            'currencyList'  => config('locale.currency_code'),
            'countries'     => $this->countryRepository->all('order', 'asc'),
            'cities'        => $this->cityRepository->all('order', 'asc'),
            'advertisers'   => $this->advertiserRepository->all('name', 'asc'),
            'areas'         => $this->areaRepository->all('order', 'asc'),
            'campaign'      => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param     $request
     *
     * @return \Response
     */
    public function update($id, CampaignRequest $request)
    {
        /** @var \App\Models\Campaign $model */
        $model = $this->campaignRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only(['name', 'description', 'minimum_revenue',
            'maximum_revenue', 'budget_currency_code', 'budget',
            'start_date', 'end_date', 'country_code', 'advertiser_id', 'city_id',]);
        $input['minimum_revenue'] = $request->get('minimum_revenue', 0);
        $input['maximum_revenue'] = $request->get('maximum_revenue', 0);
        $this->campaignRepository->update($model, $input);
        if ($request->hasFile('brand_image')) {
            $file = $request->file('brand_image');
            $mediaType = $file->getClientMimeType();
            $path = $file->getPathname();
            $image = $this->fileUploadService->upload('campaign-image', $path, $mediaType, [
                'entityType' => 'campaign',
                'entityId'   => $model->id,
                'title'      => $request->input('name', ''),
            ]);

            if (!empty($image)) {
                $this->campaignRepository->update($model, ['brand_image_id' => $image->id]);
            }
        }
        if(!empty($request->get('wrapping_base_panel', ''))){
            $this->uploadWrappingImage($model, $request->get('wrapping_base_panel', ''),'panel',$request);
        }
        if(!empty($request->get('wrapping_base_partial', ''))){
            $this->uploadWrappingImage($model, $request->get('wrapping_base_partial', ''),'partial',$request);
        }
        if(!empty($request->get('wrapping_base_full', ''))){
            $this->uploadWrappingImage($model, $request->get('wrapping_base_full', ''),'full',$request);
        }
        $areas = $request->get('area_id', []);
        $this->campaignAreaRepository->updateList($model->id, $areas);

        return redirect()->action('Admin\CampaignController@show', [$id])
            ->with('message-success', trans('admin.messages.general.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
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

        return redirect()->action('Admin\CampaignController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }

    private function uploadWrappingImage($campaign, $wrappingBase, $wrappingType, BaseRequest $request)
    {
        $wrappingImageName = 'wrapping_image_'.$wrappingType;
        $campaignImage = $this->campaignImageRepository->findByCampaignIdAndImageType($campaign->id, $wrappingType);
        if(empty($campaignImage)){
            $campaignImage = $this->campaignImageRepository->create([
                'base_revenue'=>$wrappingBase,'currency_code'=>$request->get('budget_currency_code', ''),
                'image_type'=>$wrappingType,'campaign_id'=>$campaign->id]);
        }
        $wrappingImageData = ['base_revenue'=>$wrappingBase];
        if ($request->hasFile($wrappingImageName)) {

            $file      = $request->file($wrappingImageName);
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileUploadService->upload('campaign-image', $path, $mediaType, [
                'entityType' => 'campaign',
                'entityId'   => $campaignImage->id,
                'title'      => $campaign->name,
            ]);

            if (!empty($image)) {
                $wrappingImageData['image_id'] = $image->id;
            }
        }
        $this->campaignImageRepository->update($campaignImage, $wrappingImageData);
    }
}
