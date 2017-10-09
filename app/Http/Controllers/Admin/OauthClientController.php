<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\OauthClientRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\OauthClientRepositoryInterface;
use Laravel\Passport\ClientRepository;

class OauthClientController extends Controller
{
    /** @var \App\Repositories\OauthClientRepositoryInterface */
    protected $oauthClientRepository;

    public function __construct(
        OauthClientRepositoryInterface $oauthClientRepository
    ) {
        $this->oauthClientRepository = $oauthClientRepository;
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
        $count  = $this->oauthClientRepository->count();
        $models = $this->oauthClientRepository->get('id', 'desc', $offset, $limit);

        return view('pages.admin.oauth-clients.index', [
            'models'  => $models,
            'count'   => $count,
            'offset'  => $offset,
            'limit'   => $limit,
            'baseUrl' => action('Admin\OauthClientController@index'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Response
     */
    public function create()
    {
        return view('pages.admin.oauth-clients.edit', [
            'isNew'       => true,
            'oauthClient' => $this->oauthClientRepository->getBlankModel(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $request
     *
     * @return \Response
     */
    public function store(OauthClientRequest $request)
    {
        $clients = new ClientRepository();

        $input = $request->only(['name', 'redirect']);
        $model = $clients->createPasswordGrantClient(
            null, $input['name'], $input['redirect']
        );

        if (empty($model)) {
            return redirect()->back()->withErrors(trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\OauthClientController@index')
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
        $model = $this->oauthClientRepository->find($id);
        if (empty($model)) {
            abort(404);
        }

        return view('pages.admin.oauth-clients.edit', [
            'isNew'       => false,
            'oauthClient' => $model,
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
    public function update($id, OauthClientRequest $request)
    {
        return redirect()->action('Admin\OauthClientController@show', [$id])
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
        /** @var \App\Models\OauthClient $model */
        $model = $this->oauthClientRepository->find($id);
        if (empty($model)) {
            abort(404);
        }
        $this->oauthClientRepository->delete($model);

        return redirect()->action('Admin\OauthClientController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }
}
