<?php
namespace App\Services\Production;

use App\Services\FirebaseServiceInterface;
use App\Services\MessagingServiceInterface;

class MessagingService extends BaseService implements MessagingServiceInterface
{
    protected $firebaseService;

    public function __construct(
        FirebaseServiceInterface $firebaseService
    ) {
        $this->firebaseService = $firebaseService;
    }

    public function createConversation($canpaignId)
    {
        $conversation = $this->firebaseService->createConversation($canpaignId);

        return $conversation;
    }

    public function createMessage($canpaignId, $message, $conversationName)
    {
        $message = $this->firebaseService->createMessage($canpaignId, $message, $conversationName);

        return $message;
    }
}
