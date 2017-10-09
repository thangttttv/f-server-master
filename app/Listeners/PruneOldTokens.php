<?php
namespace App\Listeners;

use App\Repositories\OauthRefreshTokenRepositoryInterface;
use Laravel\Passport\Events\RefreshTokenCreated;

class PruneOldTokens
{
    /** @var \App\Repositories\OauthRefreshTokenRepositoryInterface */
    protected $oauthRefreshTokenRepository;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OauthRefreshTokenRepositoryInterface $oauthRefreshTokenRepository)
    {
        $this->oauthRefreshTokenRepository = $oauthRefreshTokenRepository;
    }

    /**
     * Handle the event.
     *
     * @param RefreshTokenCreated $event
     *
     * @return void
     */
    public function handle(RefreshTokenCreated $event)
    {
        $this->oauthRefreshTokenRepository->updateOldAccessTokenRevoke($event->refreshTokenId, $event->accessTokenId);
    }
}
