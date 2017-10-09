<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AreaRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\AreaRepositoryInterface;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;

class AreaController extends Controller
{
    /** @var \App\Repositories\AreaRepositoryInterface */
    protected $areaRepository;

    /** @var \App\Repositories\CountryRepositoryInterface */
    protected $countryRepository;

    /** @var \App\Repositories\CityRepositoryInterface */
    protected $cityRepository;

    public function __construct(
        AreaRepositoryInterface $areaRepository,
        CountryRepositoryInterface $countryRepository,
        CityRepositoryInterface $cityRepository
    )
    {
        $this->areaRepository = $areaRepository;
        $this->countryRepository = $countryRepository;
        $this->cityRepository = $cityRepository;
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
        $nameLocal = $request->get('name_local', '');
        $nameEn = $request->get('name_en', '');
        $countryCode = $request->get('country_code', '');
        $cityId = $request->get('city_id', 0);
        $countries = $this->countryRepository->all('order', 'asc');
        $cities = $this->cityRepository->all('order', 'asc');
        $count = $this->areaRepository->countEnabledWithConditions($nameLocal, $nameEn, $countryCode, $cityId);
        $models = $this->areaRepository->getEnabledWithConditions($nameLocal, $nameEn, $countryCode, $cityId, 'updated_at', 'desc', $offset, $limit);

        return view('pages.admin.areas.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'nameLocal'     => $nameLocal,
            'nameEn'        => $nameEn,
            'countryCode'   => $countryCode,
            'countries'     => $countries,
            'cities'        => $cities,
            'cityId'        => $cityId,
            'params'        => [
                'name_local'    => $nameLocal,
                'name_en'       => $nameEn,
                'country_code'  => $countryCode,
                'cityId'        => $cityId,
            ],
            'baseUrl' => action('Admin\AreaController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.areas.edit', [
            'isNew'     => true,
            'area'      => $this->areaRepository->getBlankModel(),
            'countries' => $this->countryRepository->all('order', 'asc'),
            'cities'    => $this->cityRepository->all('order', 'asc'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AreaRequest $request
     *
     * @return \Response
     */
    public function store(AreaRequest $request)
    {
        $input = $request->only(['name_en', 'name_local', 'location_data', 'radius', 'country_code', 'city_id', 'order']);

        $model = $this->areaRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AreaController@index')
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
        $model = $this->areaRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.areas.edit', [
            'isNew'     => false,
            'area'      => $model,
            'countries' => $this->countryRepository->all('order', 'asc'),
            'cities'    => $this->cityRepository->all('order', 'asc'),
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
     * @param AreaRequest $request
     *
     * @return \Response
     */
    public function update($id, AreaRequest $request)
    {
        /** @var \App\Models\Area $model */
        $model = $this->areaRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only(['name_en', 'name_local', 'location_data', 'country_code', 'city_id', 'order']);

        $this->areaRepository->update($model, $input);

        return redirect()->action('Admin\AreaController@show', [$id])
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
        /** @var \App\Models\Area $model */
        $model = $this->areaRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->areaRepository->delete($model);

        return redirect()->action('Admin\AreaController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
