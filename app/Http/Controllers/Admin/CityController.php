<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CityRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\CityRepositoryInterface;
use App\Repositories\CountryRepositoryInterface;

class CityController extends Controller
{
    /** @var \App\Repositories\CityRepositoryInterface */
    protected $cityRepository;

    /** @var \App\Repositories\CountryRepositoryInterface */
    protected $countryRepository;

    public function __construct(
        CountryRepositoryInterface $countryRepository,
        CityRepositoryInterface $cityRepository
    ) {
        $this->countryRepository = $countryRepository;
        $this->cityRepository    = $cityRepository;
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
        $limit  = $request->limit();

        $nameLocal   = $request->get('name_local', '');
        $nameEn      = $request->get('name_en', '');
        $countryCode = $request->get('country_code', '');
        $countries   = $this->countryRepository->all('order', 'asc');
        $count       = $this->cityRepository->countEnabledWithConditions($nameLocal, $nameEn, $countryCode);
        $models      = $this->cityRepository->getEnabledWithConditions($nameLocal, $nameEn, $countryCode, 'updated_at', 'desc', $offset, $limit);

        return view('pages.admin.cities.index', [
            'models'        => $models,
            'count'         => $count,
            'offset'        => $offset,
            'limit'         => $limit,
            'nameLocal'     => $nameLocal,
            'nameEn'        => $nameEn,
            'countryCode'   => $countryCode,
            'countries'     => $countries,
            'params'        => [
                'name_local'    => $nameLocal,
                'name_en'       => $nameEn,
                'country_code'  => $countryCode,
            ],
            'baseUrl' => action('Admin\CityController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        $countries = $this->countryRepository->all('order', 'asc');

        return view('pages.admin.cities.edit', [
            'isNew'     => true,
            'countries' => $countries,
            'city'      => $this->cityRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(CityRequest $request)
    {
        $input = $request->only(['name_en', 'name_local', 'country_code', 'order']);
        $model = $this->cityRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\CityController@index')
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
        $model = $this->cityRepository->find($id);
        if (empty($model)) {
            \App::abort(404);
        }

        $countries = $this->countryRepository->all('order', 'asc');

        return view('pages.admin.cities.edit', [
            'isNew'     => false,
            'city'      => $model,
            'countries' => $countries,
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
    public function update($id, CityRequest $request)
    {
        /** @var \App\Models\City $model */
        $model = $this->cityRepository->find($id);
        if (empty($model)) {
            \App::abort(404);
        }
        $input = $request->only(['name_en', 'name_local', 'country_code', 'order']);
        $this->cityRepository->update($model, $input);

        return redirect()->action('Admin\CityController@show', [$id])
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
        /** @var \App\Models\City $model */
        $model = $this->cityRepository->find($id);
        if (empty($model)) {
            \App::abort(404);
        }
        $this->cityRepository->delete($model);

        return redirect()->action('Admin\CityController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
