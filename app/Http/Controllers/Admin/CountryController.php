<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CountryRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\CountryRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Services\FileUploadServiceInterface;
use App\Services\ImageServiceInterface;

class CountryController extends Controller
{
    /** @var \App\Repositories\CountryRepositoryInterface */
    protected $countryRepository;
    /** @var FileUploadServiceInterface $fileUploadService */
    protected $fileUploadService;

    /** @var ImageRepositoryInterface $imageRepository */
    protected $imageRepository;

    /** @var ImageServiceInterface $imageService */
    protected $imageService;

    public function __construct(
        CountryRepositoryInterface $countryRepository,
        FileUploadServiceInterface $fileUploadService,
        ImageRepositoryInterface $imageRepository,
        ImageServiceInterface $imageService
    ) {
        $this->countryRepository = $countryRepository;
        $this->fileUploadService = $fileUploadService;
        $this->imageRepository   = $imageRepository;
        $this->imageService      = $imageService;
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
        $count       = $this->countryRepository->countEnabledWithConditions($nameLocal, $nameEn, $countryCode);
        $models      = $this->countryRepository->getEnabledWithConditions($nameLocal, $nameEn, $countryCode, 'updated_at', 'desc', $offset, $limit);

        return view('pages.admin.countries.index', [
            'models'       => $models,
            'count'        => $count,
            'offset'       => $offset,
            'limit'        => $limit,
            'nameLocal'    => $nameLocal,
            'nameEn'       => $nameEn,
            'countryCode'  => $countryCode,
            'params'       => [
                'name_ja'       => $nameLocal,
                'name_local'    => $nameEn,
                'country_code'  => $countryCode,
            ],
            'baseUrl' => action('Admin\CountryController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.countries.edit', [
            'isNew'     => true,
            'country'   => $this->countryRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(CountryRequest $request)
    {
        $this->validate($request, [
            'code' => 'required|unique:countries,code',
        ]);
        $input = $request->only(['code', 'name_local', 'name_en', 'order']);

        $model = $this->countryRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        if ($request->hasFile('flag_image')) {
            $file      = $request->file('flag_image');
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileUploadService->upload('country-flag-image', $path, $mediaType, [
                'entityType' => 'country',
                'entityId'   => $model->id,
                'title'      => $request->input('name_local', ''),
            ]);

            if (!empty($image)) {
                $this->countryRepository->update($model, [
                    'flag_image_id' => $image->id,
                ]);
            }
        }

        return redirect()->action('Admin\CountryController@index')
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
        $model = $this->countryRepository->find($id);
        if (empty($model)) {
            \App::abort(404);
        }

        return view('pages.admin.countries.edit', [
            'isNew'   => false,
            'country' => $model,
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
    public function update($id, CountryRequest $request)
    {
        /* @var \App\Models\Country $model */
        $this->validate($request, [
            'code' => 'required|unique:countries,code,'.$id,
        ]);
        $model = $this->countryRepository->find($id);
        if (empty($model)) {
            \App::abort(404);
        }
        $input = $request->only(['code', 'name_local', 'name_en', 'order']);

        $this->countryRepository->update($model, $input);
        if ($request->hasFile('flag_image')) {
            $file      = $request->file('flag_image');
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileUploadService->upload('country-flag-image', $path, $mediaType, [
                'entityType' => 'country',
                'entityId'   => $model->id,
                'title'      => $request->input('name_local', ''),
            ]);

            if (!empty($image)) {
                $imageOld = $model->flagImage;
                if (!empty($imageOld)) {
                    $this->fileUploadService->delete($imageOld);
                    $this->imageRepository->delete($imageOld);
                }
                $this->countryRepository->update($model, ['flag_image_id' => $image->id]);
            }
        }

        return redirect()->action('Admin\CountryController@show', [$id])
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
        /** @var \App\Models\Country $model */
        $model = $this->countryRepository->find($id);
        if (empty($model)) {
            \App::abort(404);
        }
        $this->countryRepository->delete($model);

        return redirect()->action('Admin\CountryController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
