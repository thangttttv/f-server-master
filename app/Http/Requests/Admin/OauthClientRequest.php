<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\OauthClientRepositoryInterface;

class OauthClientRequest extends BaseRequest
{
    /** @var \App\Repositories\OauthClientRepositoryInterface */
    protected $oauthClientRepository;

    public function __construct(OauthClientRepositoryInterface $oauthClientRepository)
    {
        $this->oauthClientRepository = $oauthClientRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'     => 'required',
            'redirect' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => trans('validation.required'),
            'redirect.required' => trans('validation.required'),
        ];
    }
}
