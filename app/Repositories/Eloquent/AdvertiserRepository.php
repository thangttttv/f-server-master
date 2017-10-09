<?php
namespace App\Repositories\Eloquent;

use App\Models\Advertiser;
use App\Repositories\AdvertiserRepositoryInterface;

class AdvertiserRepository extends AuthenticatableRepository implements AdvertiserRepositoryInterface
{
    /**
     * @return Advertiser
     */
    public function getBlankModel()
    {
        return new Advertiser();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
