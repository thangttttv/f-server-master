<?php

namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;

use App\Http\Requests\PaginationRequest;
use App\Repositories\AdvertiserNotificationRepositoryInterface;
use App\Services\AdvertiserServiceInterface;

class NotificationController extends Controller
{
    protected $notificationRepository;

    protected $advertiserService;

    public function __construct(
        AdvertiserNotificationRepositoryInterface $notificationRepository,
        AdvertiserServiceInterface $advertiserService
    )
    {
        $this->notificationRepository = $notificationRepository;
        $this->advertiserService      = $advertiserService;
    }

    /**
     * Display a listing of the resource.
     * @param \App\Http\Requests\PaginationRequest $request
     * @return \Response
     */
    public function index(PaginationRequest $request)
    {
        $advertiserId = $this->advertiserService->getUser()->id;
        $offset       = $request->offset();
        $limit        = $request->limit();
        $count        = $this->notificationRepository->countByAdvertiserId($advertiserId);
        $models       = $this->notificationRepository->getByAdvertiserId($advertiserId, 'id', 'desc', $offset, $limit);

        return view('pages.advertiser.notification.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'menu'    => 'notification',
            'baseUrl' => action('Advertiser\NotificationController@index'),
        ]);
    }
}
