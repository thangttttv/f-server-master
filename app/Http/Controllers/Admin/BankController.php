<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\BankRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\BankRepositoryInterface;

class BankController extends Controller
{
    /** @var \App\Repositories\BankRepositoryInterface */
    protected $bankRepository;

    public function __construct(
        BankRepositoryInterface $bankRepository
    ) {
        $this->bankRepository = $bankRepository;
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
        $count  = $this->bankRepository->count();
        $models = $this->bankRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.banks.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\BankController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.banks.edit', [
            'isNew'     => true,
            'bank'      => $this->bankRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(BankRequest $request)
    {
        $input = $request->only(['name', 'description', 'order']);

        $model = $this->bankRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\BankController@index')
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
        $model = $this->bankRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.banks.edit', [
            'isNew' => false,
            'bank'  => $model,
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
    public function update($id, BankRequest $request)
    {
        /** @var \App\Models\Bank $model */
        $model = $this->bankRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only(['name', 'description', 'order']);

        $this->bankRepository->update($model, $input);

        return redirect()->action('Admin\BankController@show', [$id])
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
        /** @var \App\Models\Bank $model */
        $model = $this->bankRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->bankRepository->delete($model);

        return redirect()->action('Admin\BankController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
