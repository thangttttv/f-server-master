<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\AdvertiserRepositoryInterface;

class AdvertiserRequest extends BaseRequest
{
    /** @var \App\Repositories\AdvertiserRepositoryInterface */
    protected $advertiserRepository;

    public function __construct(AdvertiserRepositoryInterface $advertiserRepository)
    {
        $this->advertiserRepository = $advertiserRepository;
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
            'name'   => 'required',
            'email'  => 'required',
            'locale' => 'required',
        ];
    }

    public function messages()
    {
        return $this->advertiserRepository->messages();
    }
}
