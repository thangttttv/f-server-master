<?php
namespace App\Services;

interface FirebaseServiceInterface extends BaseServiceInterface
{
    public function createConversation($campaignId);

    public function createMessage($campaignId, $message, $conversationName);
}
