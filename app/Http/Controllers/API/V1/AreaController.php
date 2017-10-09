<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaseRequest;
use App\Http\Responses\API\V1\Areas;
use App\Repositories\AreaRepositoryInterface;
use App\Services\APIUserServiceInterface;

class AreaController extends Controller
{
    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\AreaRepositoryInterface $areaRepository */
    protected $areaRepository;

    public function __construct(
        APIUserServiceInterface $userService,
        AreaRepositoryInterface $areaRepository
    ) {
        $this->userService          = $userService;
        $this->areaRepository       = $areaRepository;
    }

    public function getAreas($cityId, BaseRequest $request)
    {
        $areas = $this->areaRepository->getByCityId($cityId);

        return Areas::updateListWithModel($areas, 0, 0)->response();
    }
}
