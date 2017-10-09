<?php
namespace App\Services;

interface MessagingServiceInterface extends BaseServiceInterface
{
    public function createConversation($canpaignId);

    public function createMessage($canpaignId, $message, $conversationName);
}
