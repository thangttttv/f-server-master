<?php
namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginationRequest;
use App\Http\Responses\API\V1\PaymentLogs;
use App\Repositories\PaymentLogRepositoryInterface;
use App\Services\APIUserServiceInterface;

class PaymentLogController extends Controller
{
    /** @var \App\Services\APIUserServiceInterface $userService */
    protected $userService;

    /** @var \App\Repositories\PaymentLogRepositoryInterface $paymentLogRepository */
    protected $paymentLogRepository;

    public function __construct(
        APIUserServiceInterface $userService,
        PaymentLogRepositoryInterface $paymentLogRepository
    ) {
        $this->userService          = $userService;
        $this->paymentLogRepository = $paymentLogRepository;
    }

    public function index(PaginationRequest $request)
    {
        $user        = $this->userService->getUser();
        $offset      = $request->offset();
        $limit       = $request->limit();
        $order       = 'id';
        $direction   = 'desc';
        $paymentLogs = $this->paymentLogRepository->getEnabledWithConditions(
            $status = '', $paidAmount = 0, $userId = $user->id, $paidForMonth = '',
            $bankAccountId = 0, $order, $direction, $offset, $limit);
        $count = $this->paymentLogRepository->countEnabledWithConditions(
            $status = '', $paidAmount = 0, $userId = $user->id, $paidForMonth = '',
            $bankAccountId = 0);
        $hasNext = \PaginationHelper::hasNext($count, $offset, $limit);

        return PaymentLogs::updateListWithModel($paymentLogs, $offset, $limit, $hasNext)->response();
    }
}
