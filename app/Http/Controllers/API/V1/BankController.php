<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Request;
use App\Http\Responses\API\V1\Banks;
use App\Repositories\BankRepositoryInterface;
use App\Services\APIUserServiceInterface;

class BankController extends Controller
{
    /** @var \App\Services\UserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\BankRepositoryInterface $bankRepository */
    protected $bankRepository;

    public function __construct(
        APIUserServiceInterface $userService,
        BankRepositoryInterface $bankRepository
    ) {
        $this->userService    = $userService;
        $this->bankRepository = $bankRepository;
    }

    public function getBanks(Request $request)
    {
        $banks = $this->bankRepository->all();

        return Banks::updateListWithModel($banks, 0, 0)->response();
    }
}
