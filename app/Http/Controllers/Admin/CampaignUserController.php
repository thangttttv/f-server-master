<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CampaignUserRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\CampaignUser;
use App\Repositories\CampaignRepositoryInterface;
use App\Repositories\CampaignUserRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\AdminUserServiceInterface;
use App\Services\MessagingServiceInterface;

class CampaignUserController extends Controller
{
    /** @var \App\Repositories\CampaignUserRepositoryInterface */
    protected $campaignUserRepository;

    /** @var \App\Services\AdminUserServiceInterface */
    protected $adminUserService;

    /** @var \App\Services\MessagingServiceInterface */
    protected $messagingService;

    /** @var \App\Repositories\CampaignRepositoryInterface */
    protected $campaignRepository;

    /** @var \App\Repositories\UserRepositoryInterface */
    protected $userRepository;

    public function __construct(
        CampaignUserRepositoryInterface $campaignUserRepository,
        AdminUserServiceInterface $adminUserService,
        MessagingServiceInterface $messagingService,
        CampaignRepositoryInterface $campaignRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->campaignUserRepository = $campaignUserRepository;
        $this->adminUserService       = $adminUserService;
        $this->messagingService       = $messagingService;
        $this->campaignRepository     = $campaignRepository;
        $this->userRepository         = $userRepository;
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

        $status     = $request->get('status', '');
        $campaignId = $request->get('campaign_id', 0);
        $userId     = $request->get('user_id', 0);
        $count      = $this->campaignUserRepository->countEnabledWithConditions($userId, $campaignId, $status, [], []);
        $models     = $this->campaignUserRepository->getEnabledWithConditions($userId, $campaignId, $status, [], [], 'id', 'desc', $offset, $limit);

        return view('pages.admin.campaign-users.index', [
            'models'     => $models,
            'count'      => $count,
            'offset'     => $offset,
            'limit'      => $limit,
            'status'     => $status,
            'campaignId' => $campaignId,
            'userId'     => $userId,
            'params'     => [
                'status'      => $status,
                'campaign_id' => $campaignId,
                'user_id'     => $userId,
            ],
            'campaigns'  => $this->campaignRepository->all('name', 'asc'),
            'users'      => $this->userRepository->all('email', 'asc'),
            'statuses'   => [CampaignUser::TYPE_STATUS_ONGOING, CampaignUser::TYPE_STATUS_PENDING,
                CampaignUser::TYPE_STATUS_CANCELED, CampaignUser::TYPE_STATUS_FINISHED,
            ],
            'baseUrl'    => action('Admin\CampaignUserController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.campaign-users.edit', [
            'isNew'        => true,
            'campaignUser' => $this->campaignUserRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(CampaignUserRequest $request)
    {
        $input = $request->only(['status', 'finished_at']);

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $model               = $this->campaignUserRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\CampaignUserController@index')
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
        $model = $this->campaignUserRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.campaign-users.edit', [
            'isNew'        => false,
            'campaignUser' => $model,
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
    public function update($id, CampaignUserRequest $request)
    {
        /** @var \App\Models\CampaignUser $model */
        $model = $this->campaignUserRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only(['status', 'finished_at']);

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->campaignUserRepository->update($model, $input);

        return redirect()->action('Admin\CampaignUserController@show', [$id])
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
        /** @var \App\Models\CampaignUser $model */
        $model = $this->campaignUserRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->campaignUserRepository->delete($model);

        return redirect()->action('Admin\CampaignUserController@index')
            ->with('message-success', trans('admin.messages.general.delete_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Response
     */
    public function approve($id)
    {
        /** @var \App\Models\CampaignUser $model */
        $model = $this->campaignUserRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $conversation = $this->messagingService->createConversation($model->id);
        $message      = $this->messagingService->createMessage(
            $model->id, trans('admin.messages.campaign.approve_campaign'), $conversation->conversationName);

        $this->campaignUserRepository->update($model, ['status' => CampaignUser::TYPE_STATUS_ONGOING]);

        return redirect()->action('Admin\CampaignUserController@index')
            ->with('message-success', trans('admin.messages.general.update_success'));
    }
}
