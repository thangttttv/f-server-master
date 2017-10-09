<?php
namespace App\Repositories\Eloquent;

use App\Repositories\AdvertiserPasswordResetRepositoryInterface;

class AdvertiserPasswordResetRepository extends PasswordResettableRepository implements AdvertiserPasswordResetRepositoryInterface
{
    protected $tableName = 'advertiser_password_resets';
}
