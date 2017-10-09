<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\AreaWeightRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\AreaRepositoryInterface;
use App\Repositories\AreaWeightLogRepositoryInterface;
use App\Repositories\AreaWeightRepositoryInterface;
use Carbon\Carbon;

class AreaWeightController extends Controller
{
    /** @var \App\Repositories\AreaWeightRepositoryInterface */
    protected $areaWeightRepository;

    /** @var \App\Repositories\AreaWeightLogRepositoryInterface */
    protected $areaWeightLogRepository;

    /** @var \App\Repositories\AreaRepositoryInterface */
    protected $areaRepository;

    public function __construct(
        AreaWeightRepositoryInterface $areaWeightRepository,
        AreaRepositoryInterface $areaRepository,
        AreaWeightLogRepositoryInterface $areaWeightLogRepository
    ) {
        $this->areaWeightRepository    = $areaWeightRepository;
        $this->areaWeightLogRepository = $areaWeightLogRepository;
        $this->areaRepository          = $areaRepository;
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
        $count  = $this->areaWeightRepository->count();
        $models = $this->areaWeightRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.area-weights.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\AreaWeightController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.area-weights.edit', [
            'isNew'         => true,
            'areas'         => $this->areaRepository->all('order', 'asc'),
            'areaWeight'    => $this->areaWeightRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(AreaWeightRequest $request)
    {
        $input = $request->only(['area_id', 'day_of_week', 'start_time', 'end_time', 'weight']);

        $model = $this->areaWeightRepository->create($input);

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\AreaWeightController@index')
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
        $model = $this->areaWeightRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.area-weights.edit', [
            'isNew'         => false,
            'areas'         => $this->areaRepository->all('order', 'asc'),
            'areaWeight'    => $model,
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
    public function update($id, AreaWeightRequest $request)
    {
        /** @var \App\Models\AreaWeight $model */
        $model = $this->areaWeightRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $input = $request->only(['area_id', 'day_of_week', 'start_time', 'end_time', 'weight']);
        if ($model->weight != $input['weight']) {
            $this->areaWeightLogRepository->create([
                'area_id'     => $model->area_id,
                'day_of_week' => $model->day_of_week,
                'start_time'  => $model->start_time,
                'end_time'    => $model->end_time,
                'weight'      => $model->weight,
                'active_to'   => Carbon::now(),
            ]);
        }

        $this->areaWeightRepository->update($model, $input);

        return redirect()->action('Admin\AreaWeightController@show', [$id])
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
        /** @var \App\Models\AreaWeight $model */
        $model = $this->areaWeightRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->areaWeightRepository->delete($model);

        return redirect()->action('Admin\AreaWeightController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
