<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\AdvertiserNotificationRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\AdvertiserNotificationRepositoryInterface;
use App\Repositories\AdvertiserRepositoryInterface;

class AdvertiserNotificationController extends Controller
{
    /** @var \App\Repositories\AdvertiserNotificationRepositoryInterface */
    protected $advertiserNotificationRepository;

    /** @var \App\Repositories\AdvertiserRepositoryInterface */
    protected $advertiserRepository;

    public function __construct(
        AdvertiserNotificationRepositoryInterface $advertiserNotificationRepository,
        AdvertiserRepositoryInterface $advertiserRepository
    ) {
        $this->advertiserNotificationRepository = $advertiserNotificationRepository;
        $this->advertiserRepository = $advertiserRepository;
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
        $count  = $this->advertiserNotificationRepository->count();
        $models = $this->advertiserNotificationRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.advertiser-notifications.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\AdvertiserNotificationController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.advertiser-notifications.edit', [
            'isNew'                  => true,
            'advertisers'            => $this->advertiserRepository->all('name', 'asc'),
            'advertiserNotification' => $this->advertiserNotificationRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(AdvertiserNotificationRequest $request)
    {
        $input                  = $request->only(['category_type', 'type', 'data', 'content', 'locale', 'sent_at']);
        $input['read']          = $request->get('read', 0);
        $input['advertiser_id'] = $request->get('advertiser_id', 0);

        $model                  = $this->advertiserNotificationRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AdvertiserNotificationController@index')
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
        $model = $this->advertiserNotificationRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.advertiser-notifications.edit', [
            'isNew'                  => false,
            'advertisers'            => $this->advertiserRepository->all('name', 'asc'),
            'advertiserNotification' => $model,
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
    public function update($id, AdvertiserNotificationRequest $request)
    {
        /** @var \App\Models\AdvertiserNotification $model */
        $model = $this->advertiserNotificationRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input                 = $request->only(['category_type', 'type', 'content', 'locale', 'sent_at']);

        $this->advertiserNotificationRepository->update($model, $input);

        return redirect()->action('Admin\AdvertiserNotificationController@show', [$id])
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
        /** @var \App\Models\AdvertiserNotification $model */
        $model = $this->advertiserNotificationRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->advertiserNotificationRepository->delete($model);

        return redirect()->action('Admin\AdvertiserNotificationController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
