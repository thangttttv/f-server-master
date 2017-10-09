<?php
namespace App\Http\Controllers\Admin;

use App\Exceptions\APIErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImageRequest;
use App\Http\Requests\Admin\MessageImageRequest;
use App\Http\Requests\PaginationRequest;
use App\Http\Responses\API\V1\MessageImage;
use App\Http\Responses\API\V1\Response;
use App\Repositories\ImageRepositoryInterface;
use App\Services\AdminUserServiceInterface;
use App\Services\FileUploadServiceInterface;

class ImageController extends Controller
{
    /** @var \App\Repositories\ImageRepositoryInterface */
    protected $imageRepository;

    protected $fileUploadService;

    /** @var \App\Services\AdminUserServiceInterface */
    protected $userService;

    public function __construct(
        ImageRepositoryInterface $imageRepository,
        FileUploadServiceInterface $fileUploadService,
        AdminUserServiceInterface $userService
    ) {
        $this->imageRepository   = $imageRepository;
        $this->fileUploadService = $fileUploadService;
        $this->userService = $userService;
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
        $count  = $this->imageRepository->count();
        $models = $this->imageRepository->get('id', 'desc', $offset, $limit);
        if($request->ajax()){
            if ($offset != 0) {
                $layout = 'layouts.admin.ajax_paging';
            } else {
                $layout = 'layouts.admin.statistics_paging';
            }
        }else{
            $layout = 'pages.admin.images.index';
        }
        return view($layout, [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'params'  => [],
            'baseUrl' => action('Admin\ImageController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.images.edit', [
            'isNew' => true,
            'image' => $this->imageRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param MessageImageRequest $request
     *
     * @return MessageImage
     */
    public function store(MessageImageRequest $request)
    {
        if (!$request->hasFile('message_image')) {
            throw new APIErrorException('wrongParameter', 'No Image', []);
        }
        $user = $this->userService->getUser();
        $file      = $request->file('message_image');
        $mediaType = $file->getClientMimeType();
        $path      = $file->getPathname();
        $image     = $this->fileUploadService->upload('message-image', $path, $mediaType, [
            'entityType' => 'message',
            'entityId'   => $user->id,
            'title'      => '',
        ]);
        if (empty($image)) {
            if (!$request->hasFile('message_image')) {
                throw new APIErrorException('severError', 'Upload failed', []);
            }
        }
        return MessageImage::updateWithModel($image)->response();
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
        $model = $this->imageRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.images.edit', [
            'isNew' => false,
            'image' => $model,
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
    public function update($id, ImageRequest $request)
    {
        /** @var \App\Models\Image $model */
        $model = $this->imageRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only([
            'url',
            'title',
            'entity_type',
            'entity_id',
            'file_category_type',
            's3_key',
            's3_bucket',
            's3_region',
            's3_extension',
            'media_type',
            'format',
            'file_size',
            'width',
            'height',
        ]);
        $input['is_enabled'] = $request->get('is_enabled', 0);
        foreach (['s3_key', 's3_bucket', 's3_region'] as $key) {
            if (empty($input[$key])) {
                $input[$key] = '';
            }
        }
        $this->imageRepository->update($model, $input);

        return redirect()->action('Admin\ImageController@show', [$id])->with('message-success',
            trans('admin.messages.general.update_success'));
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
        /** @var \App\Models\Image $model */
        $model = $this->imageRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        $this->fileUploadService->delete($model);
        $this->imageRepository->delete($model);

        return redirect()->action('Admin\ImageController@index')->with('message-success',
            trans('admin.messages.general.delete_success'));
    }

}
