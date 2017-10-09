<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class ChatController extends Controller
{
    /** @var \App\Repositories\UserRepositoryInterface */
    protected $userRepository;

    /** @var \App\Repositories\CampaignRepositoryInterface */
    protected $campaignRepository;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface,
        CampaignRepositoryInterface $campaignRepository
    ) {
        $this->userRepository     = $userRepositoryInterface;
        $this->campaignRepository = $campaignRepository;
    }

    public function index(PaginationRequest $request)
    {
        $offset = $request->offset();
        $limit  = $request->limit();

        $order     = $request->order();
        $direction = $request->direction('desc');

        $users = $this->userRepository->get($order, $direction, $offset, $limit);
        $count = $this->userRepository->count();

        return view('pages.admin.chat.index', [
            'users'     => $users,
            'offset'    => $offset,
            'limit'     => $limit,
            'count'     => $count,
            'order'     => $order,
            'direction' => $direction,
            'baseUrl'   => action('Admin\ChatController@index'),
        ]);
    }

    public function chat($userId, $campaignId, BaseRequest $request)
    {
        $user     = $this->userRepository->find($userId);
        $campaign = $this->campaignRepository->find($campaignId);

        return view('pages.admin.chat.chat', [
            'user'     => $user,
            'campaign' => $campaign,
        ]);
    }
}
