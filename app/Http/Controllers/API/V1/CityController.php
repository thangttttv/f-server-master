<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use App\Http\Responses\API\V1\Cities;
use App\Repositories\CityRepositoryInterface;
use App\Services\APIUserServiceInterface;

class CityController extends Controller
{
    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\CityRepositoryInterface $cityRepository */
    protected $cityRepository;

    public function __construct(
        APIUserServiceInterface $userService,
        CityRepositoryInterface $cityRepository
    ) {
        $this->userService       = $userService;
        $this->cityRepository    = $cityRepository;
    }

    public function getCities($countryCode, BaseRequest $request)
    {
        $cities = $this->cityRepository->allByCountryCode($countryCode);

        return Cities::updateListWithModel($cities, 0, 0)->response();
    }
}
