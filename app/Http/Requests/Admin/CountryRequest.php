<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\CountryRepositoryInterface;

class CountryRequest extends BaseRequest
{
    /** @var \App\Repositories\CountryRepositoryInterface */
    protected $countryRepository;

    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
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
            'name_en'    => 'required|max:255|min:2',
            'name_local' => 'required|max:255|min:2',
            'code'       => 'required',
            'order'      => 'required|numeric',
        ];
    }

    public function messages()
    {
        return $this->countryRepository->messages();
    }
}
