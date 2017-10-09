<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\AdvertiserRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\AdvertiserRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;
use App\Services\FileUploadServiceInterface;
use App\Services\ImageServiceInterface;

class AdvertiserController extends Controller
{
    /** @var \App\Repositories\AdvertiserRepositoryInterface */
    protected $advertiserRepository;

    /** @var FileUploadServiceInterface $fileUploadService */
    protected $fileUploadService;

    /** @var ImageRepositoryInterface $imageRepository */
    protected $imageRepository;

    /** @var ImageServiceInterface $imageService */
    protected $imageService;

    public function __construct(
        AdvertiserRepositoryInterface $advertiserRepository,
        FileUploadServiceInterface $fileUploadService,
        ImageRepositoryInterface $imageRepository,
        ImageServiceInterface $imageService
    ) {
        $this->advertiserRepository = $advertiserRepository;
        $this->fileUploadService    = $fileUploadService;
        $this->imageRepository      = $imageRepository;
        $this->imageService         = $imageService;
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
        $count  = $this->advertiserRepository->count();
        $models = $this->advertiserRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.advertisers.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\AdvertiserController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.advertisers.edit', [
            'isNew'      => true,
            'advertiser' => $this->advertiserRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(AdvertiserRequest $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|unique:advertisers,email',
            'password' => 'required|min:6',
        ]);
        $input = $request->only(['name', 'email', 'password', 'locale']);

        $model = $this->advertiserRepository->create($input);
        if ($request->hasFile('profile_image')) {
            $file      = $request->file('profile_image');
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileUploadService->upload('advertiser-profile-image', $path, $mediaType, [
                'entityType' => 'advertiser-profile',
                'entityId'   => $model->id,
                'title'      => $request->input('name', ''),
            ]);

            if (!empty($image)) {
                $this->advertiserRepository->update($model, [
                    'profile_image_id' => $image->id,
                ]);
            }
        }

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AdvertiserController@index')
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
        $model = $this->advertiserRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.advertisers.edit', [
            'isNew'      => false,
            'advertiser' => $model,
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
    public function update($id, AdvertiserRequest $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:advertisers,email,'.$id,
        ]);
        /** @var \App\Models\Advertiser $model */
        $model = $this->advertiserRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only(['name', 'email', 'locale']);

        $this->advertiserRepository->update($model, $input);

        if ($request->hasFile('profile_image')) {
            $file      = $request->file('profile_image');
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileUploadService->upload('advertiser-profile-image', $path, $mediaType, [
                'entityType' => 'advertiser-profile',
                'entityId'   => $model->id,
                'title'      => $request->input('name', ''),
            ]);

            if (!empty($image)) {
                $this->advertiserRepository->update($model, [
                    'profile_image_id' => $image->id,
                ]);
            }
        } elseif (!empty($request->get('image_id'))) {
            $this->advertiserRepository->update($model, [
                'profile_image_id' => $request->get('image_id'),
            ]);
        }

        return redirect()->action('Admin\AdvertiserController@show', [$id])
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
        /** @var \App\Models\Advertiser $model */
        $model = $this->advertiserRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->advertiserRepository->delete($model);

        return redirect()->action('Admin\AdvertiserController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
