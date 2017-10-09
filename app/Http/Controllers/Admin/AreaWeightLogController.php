<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\AreaWeightLogRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\AreaWeightLogRepositoryInterface;

class AreaWeightLogController extends Controller
{
    /** @var \App\Repositories\AreaWeightLogRepositoryInterface */
    protected $areaWeightLogRepository;

    public function __construct(
        AreaWeightLogRepositoryInterface $areaWeightLogRepository
    ) {
        $this->areaWeightLogRepository = $areaWeightLogRepository;
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
        $count  = $this->areaWeightLogRepository->count();
        $models = $this->areaWeightLogRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.area-weight-logs.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\AreaWeightLogController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.area-weight-logs.edit', [
            'isNew'         => true,
            'areaWeightLog' => $this->areaWeightLogRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(AreaWeightLogRequest $request)
    {
        $input = $request->only([]);

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $model               = $this->areaWeightLogRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AreaWeightLogController@index')
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
        $model = $this->areaWeightLogRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.area-weight-logs.edit', [
            'isNew'         => false,
            'areaWeightLog' => $model,
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
    public function update($id, AreaWeightLogRequest $request)
    {
        /** @var \App\Models\AreaWeightLog $model */
        $model = $this->areaWeightLogRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only([]);

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->areaWeightLogRepository->update($model, $input);

        return redirect()->action('Admin\AreaWeightLogController@show', [$id])
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
        /** @var \App\Models\AreaWeightLog $model */
        $model = $this->areaWeightLogRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->areaWeightLogRepository->delete($model);

        return redirect()->action('Admin\AreaWeightLogController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
