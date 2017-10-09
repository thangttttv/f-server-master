<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\PaymentLogRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\PaymentLog;
use App\Repositories\BankAccountRepositoryInterface;
use App\Repositories\PaymentLogRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class PaymentLogController extends Controller
{
    /** @var \App\Repositories\PaymentLogRepositoryInterface */
    protected $paymentLogRepository;

    /** @var \App\Repositories\UserRepositoryInterface */
    protected $userRepository;

    /** @var \App\Repositories\BankAccountRepositoryInterface */
    protected $bankAccountRepository;

    public function __construct(
        PaymentLogRepositoryInterface $paymentLogRepository,
        UserRepositoryInterface $userRepository,
        BankAccountRepositoryInterface $bankAccountRepository
    ) {
        $this->paymentLogRepository         = $paymentLogRepository;
        $this->userRepository               = $userRepository;
        $this->bankAccountRepository        = $bankAccountRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\PaginationRequest $request
     *
     * @return \Response
     */
    public function index(PaginationRequest $request)
    {
        $offset = $request->offset();
        $limit  = $request->limit();
        $count  = $this->paymentLogRepository->count();
        $models = $this->paymentLogRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.payment-logs.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\PaymentLogController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.payment-logs.edit', [
            'isNew'         => true,
            'statuses'      => [PaymentLog::TYPE_STATUS_PAID],
            'users'         => $this->userRepository->all(),
            'bankAccounts'  => $this->bankAccountRepository->all(),
            'paymentLog'    => $this->paymentLogRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(PaymentLogRequest $request)
    {
        $input = $request->only(['status', 'paid_amount', 'paid_for_month',
            'currency_code', 'paid_at', 'note', 'user_id', 'bank_account_id', ]);

        $model = $this->paymentLogRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\PaymentLogController@index')
            ->with('message-success', trans('admin.messages.general.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Response
     */
    public function show($id)
    {
        $model = $this->paymentLogRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.payment-logs.edit', [
            'isNew'         => false,
            'statuses'      => [PaymentLog::TYPE_STATUS_PAID],
            'users'         => $this->userRepository->all(),
            'bankAccounts'  => $this->bankAccountRepository->all(),
            'paymentLog'    => $model,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param     $request
     *
     * @return \Response
     */
    public function update($id, PaymentLogRequest $request)
    {
        /** @var \App\Models\PaymentLog $model */
        $model = $this->paymentLogRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only(['status', 'paid_amount', 'paid_for_month',
            'currency_code', 'paid_at', 'note', 'user_id', 'bank_account_id', ]);

        $this->paymentLogRepository->update($model, $input);

        return redirect()->action('Admin\PaymentLogController@show', [$id])
                    ->with('message-success', trans('admin.messages.general.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Response
     */
    public function destroy($id)
    {
        /** @var \App\Models\PaymentLog $model */
        $model = $this->paymentLogRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->paymentLogRepository->delete($model);

        return redirect()->action('Admin\PaymentLogController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
