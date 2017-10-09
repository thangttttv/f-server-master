<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\CampaignImageRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\CampaignImageRepositoryInterface;
use App\Repositories\CampaignRepositoryInterface;
use App\Services\FileUploadServiceInterface;

class CampaignImageController extends Controller
{
    /** @var \App\Repositories\CampaignImageRepositoryInterface */
    protected $campaignImageRepository;

    /** @var \App\Repositories\CampaignRepositoryInterface */
    protected $campaignRepository;

    /** @var \App\Services\FileUploadServiceInterface */
    protected $fileUploadService;

    public function __construct(
        CampaignImageRepositoryInterface $campaignImageRepository,
        CampaignRepositoryInterface $campaignRepository,
        FileUploadServiceInterface $fileUploadService
    ) {
        $this->campaignImageRepository = $campaignImageRepository;
        $this->campaignRepository      = $campaignRepository;
        $this->fileUploadService       = $fileUploadService;
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
        $count  = $this->campaignImageRepository->count();
        $models = $this->campaignImageRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.campaign-images.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\CampaignImageController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.campaign-images.edit', [
            'isNew'         => true,
            'campaigns'     => $this->campaignRepository->all('name', 'asc'),
            'campaignImage' => $this->campaignImageRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(CampaignImageRequest $request)
    {
        $input    = $request->only(['base_revenue', 'currency_code', 'campaign_id', 'image_type']);
        $campaign = $this->campaignRepository->find($input['campaign_id']);
        if (empty($campaign)) {
            abort(404);
        }
        $model = $this->campaignImageRepository->create($input);
        if ($request->hasFile('campaign_image')) {
            $file      = $request->file('campaign_image');
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileUploadService->upload('campaign-image', $path, $mediaType, [
                'entityType' => 'campaign',
                'entityId'   => $model->id,
                'title'      => $campaign->name,
            ]);

            if (!empty($image)) {
                $this->campaignImageRepository->update($model, [
                    'image_id' => $image->id,
                ]);
            }
        }
        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\CampaignImageController@index')
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
        $model = $this->campaignImageRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.campaign-images.edit', [
            'isNew'         => false,
            'campaigns'     => $this->campaignRepository->all('name', 'asc'),
            'campaignImage' => $model,
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
    public function update($id, CampaignImageRequest $request)
    {
        /** @var \App\Models\CampaignImage $model */
        $model = $this->campaignImageRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input    = $request->only(['base_revenue', 'currency_code', 'campaign_id', 'image_type']);
        $campaign = $this->campaignRepository->find($input['campaign_id']);
        if (empty($campaign)) {
            abort(404);
        }

        $this->campaignImageRepository->update($model, $input);
        if ($request->hasFile('campaign_image')) {
            $file      = $request->file('campaign_image');
            $mediaType = $file->getClientMimeType();
            $path      = $file->getPathname();
            $image     = $this->fileUploadService->upload('campaign-image', $path, $mediaType, [
                'entityType' => 'campaign',
                'entityId'   => $model->id,
                'title'      => $campaign->name,
            ]);

            if (!empty($image)) {
                $this->campaignImageRepository->update($model, [
                    'image_id' => $image->id,
                ]);
            }
        }

        return redirect()->action('Admin\CampaignImageController@show', [$id])
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
        /** @var \App\Models\CampaignImage $model */
        $model = $this->campaignImageRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->campaignImageRepository->delete($model);

        return redirect()->action('Admin\CampaignImageController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
