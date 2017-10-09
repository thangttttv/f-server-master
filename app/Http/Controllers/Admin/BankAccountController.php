<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\BankAccountRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\BankAccountRepositoryInterface;
use App\Repositories\BankRepositoryInterface;
use App\Repositories\UserRepositoryInterface;

class BankAccountController extends Controller
{
    /** @var \App\Repositories\BankAccountRepositoryInterface */
    protected $bankAccountRepository;

    /** @var \App\Repositories\BankRepositoryInterface */
    protected $bankRepository;

    /** @var \App\Repositories\UserRepositoryInterface */
    protected $userRepository;

    public function __construct(
        BankAccountRepositoryInterface $bankAccountRepository,
        BankRepositoryInterface $bankRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->bankAccountRepository = $bankAccountRepository;
        $this->bankRepository        = $bankRepository;
        $this->userRepository        = $userRepository;
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
        $count  = $this->bankAccountRepository->count();
        $models = $this->bankAccountRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.bank-accounts.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\BankAccountController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.bank-accounts.edit', [
            'isNew'       => true,
            'users'       => $this->userRepository->all(),
            'banks'       => $this->bankRepository->all(),
            'bankAccount' => $this->bankAccountRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(BankAccountRequest $request)
    {
        $input = $request->only(['owner_name', 'account_info', 'branch_name', 'user_id', 'bank_id']);

        $model = $this->bankAccountRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\BankAccountController@index')
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
        $model = $this->bankAccountRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.bank-accounts.edit', [
            'isNew'       => false,
            'users'       => $this->userRepository->all(),
            'banks'       => $this->bankRepository->all(),
            'bankAccount' => $model,
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
    public function update($id, BankAccountRequest $request)
    {
        /** @var \App\Models\BankAccount $model */
        $model = $this->bankAccountRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only(['owner_name', 'account_info', 'branch_name', 'user_id', 'bank_id']);

        $this->bankAccountRepository->update($model, $input);

        return redirect()->action('Admin\BankAccountController@show', [$id])
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
        /** @var \App\Models\BankAccount $model */
        $model = $this->bankAccountRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->bankAccountRepository->delete($model);

        return redirect()->action('Admin\BankAccountController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
