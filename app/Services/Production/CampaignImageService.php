<?php
namespace App\Services\Production;

use App\Exceptions\APIErrorException;
use App\Repositories\CampaignImageRepositoryInterface;
use App\Services\CampaignImageServiceInterface;

class CampaignImageService extends BaseService implements CampaignImageServiceInterface
{
    /** @var CampaignImageRepositoryInterface $resetEmailTemplate */
    protected $campaignImageRepository;

    public function __construct(
        CampaignImageRepositoryInterface $campaignImageRepository
    ) {
        $this->campaignImageRepository    = $campaignImageRepository;
    }

    public function costCalculator($distance, $campaignImageId)
    {
        $campaignImage = $this->campaignImageRepository->find($campaignImageId);
        if (empty($campaignImage)) {
            throw new APIErrorException('notFoundWrappingImage', 'Image wrapping not found', []);
        }

        return $campaignImage->base_revenue * $distance;
    }
}
