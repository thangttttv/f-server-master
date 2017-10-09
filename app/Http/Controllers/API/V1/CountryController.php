<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use App\Http\Responses\API\V1\Countries;
use App\Repositories\CountryRepositoryInterface;
use App\Services\APIUserServiceInterface;

class CountryController extends Controller
{
    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\CountryRepositoryInterface $countryRepository */
    protected $countryRepository;

    public function __construct(
        APIUserServiceInterface $userService,
        CountryRepositoryInterface $countryRepository
    ) {
        $this->userService       = $userService;
        $this->countryRepository = $countryRepository;
    }

    public function allCountries(BaseRequest $request)
    {
        $countries = $this->countryRepository->all('id', 'desc');

        return Countries::updateListWithModel($countries, 0, 0)->response();
    }
}
