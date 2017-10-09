<?php
namespace App\Services\Production;

use App\Repositories\AdvertiserPasswordResetRepositoryInterface;
use App\Repositories\AdvertiserRepositoryInterface;
use App\Services\AdvertiserServiceInterface;

class AdvertiserService extends AuthenticatableService implements AdvertiserServiceInterface
{
    /** @var string $resetEmailTitle */
    protected $resetEmailTitle = 'Reset Password';

    /** @var string $resetEmailTemplate */
    protected $resetEmailTemplate = 'emails.advertiser.reset_password';

    public function __construct(
        AdvertiserRepositoryInterface $advertiserRepository,
        AdvertiserPasswordResetRepositoryInterface $advertiserPasswordResetRepository
    ) {
        $this->authenticatableRepository    = $advertiserRepository;
        $this->passwordResettableRepository = $advertiserPasswordResetRepository;
    }

    public function getGuardName()
    {
        return 'advertisers';
    }
}
