<?php
namespace App\Services\Production;

use App\Repositories\CampaignUserRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Services\AdminUserServiceInterface;
use App\Services\FirebaseServiceInterface;


class FirebaseService extends BaseService implements FirebaseServiceInterface
{
    protected $firebase;

    protected $conversationPath;

    protected $messagePath;

    protected $adminUserService;

    protected $campaignUserRepository;

    protected $userRepository;

    public function __construct(
        AdminUserServiceInterface $adminUserService,
        CampaignUserRepositoryInterface $campaignUserRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->firebase               = new \Firebase\FirebaseLib(config('services.firebase.firebase_url'), '');
        $this->adminUserService       = $adminUserService;
        $this->campaignUserRepository = $campaignUserRepository;
        $this->userRepository         = $userRepository;
        $this->messagePath            = 'messages/';
        $this->conversationPath       = 'conversations/';
    }

    public function createConversation($campaignId)
    {
        $adminUser        = $this->adminUserService->getUser();
        $currentCampaign  = $this->campaignUserRepository->find($campaignId);
        $user             = $this->userRepository->find($currentCampaign->user_id);
        $keyConversation  = $currentCampaign->user_id.'-'.$currentCampaign->campaign_id;
        $conversation     = $this->firebase->get($this->conversationPath.$keyConversation);
        $conversationName = $currentCampaign->present()->campaignName().' - '.$user->email;
        $newConversation  = [
            'sender'      => 'admin',
            'adminId'     => $adminUser->id,
            'userId'      => $currentCampaign->user_id,
            'lastMessage' => trans('admin.messages.campaign.approve_campaign'),
            'name'        => $conversationName, 'time' => time(),
        ];
        if (empty($conversation) || $conversation == 'null') {
            $conversation = $this->firebase->set($this->conversationPath.$keyConversation, $newConversation);
        }
        $conversation                   = json_decode($conversation);
        $conversation->conversationName = $keyConversation;

        return $conversation;
    }

    public function createMessage($campaignId, $message, $conversationName)
    {
        $adminUser       = $this->adminUserService->getUser();
        $currentCampaign = $this->campaignUserRepository->find($campaignId);
        $newMessage      = ['sender'           => 'admin',
                       'adminId'               => $adminUser->id,
                       'userId'                => $currentCampaign->user_id,
                       'text'                  => $message,
                       'conversationName'      => $conversationName,
                       'name'                  => $conversationName,
                       'time'                  => time(),
        ];
        $message = $this->firebase->push($this->messagePath, $newMessage);

        return $message;
    }
}
