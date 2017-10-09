<?php
namespace App\Listeners;

use App\Repositories\OauthAccessTokenRepositoryInterface;
use Laravel\Passport\Events\AccessTokenCreated;

class RevokeOldTokens
{
    /** @var \App\Repositories\OauthAccessTokenRepositoryInterface */
    protected $oauthAccessTokenRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OauthAccessTokenRepositoryInterface $oauthAccessTokenRepository)
    {
        $this->oauthAccessTokenRepository = $oauthAccessTokenRepository;
    }

    /**
     * Handle the event.
     *
     * @param AccessTokenCreated $event
     *
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        $this->oauthAccessTokenRepository->updateOldTokenRevoke($event->tokenId, $event->userId, $event->clientId);
    }
}
