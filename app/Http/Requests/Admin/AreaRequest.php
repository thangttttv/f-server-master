<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\AreaRepositoryInterface;

class AreaRequest extends BaseRequest
{
    /** @var \App\Repositories\AreaRepositoryInterface */
    protected $areaRepository;

    public function __construct(AreaRepositoryInterface $areaRepository)
    {
        $this->areaRepository = $areaRepository;
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
          'name_en'         => 'required',
          'name_local'      => 'required',
          'location_data'   => 'required',
          'order'           => 'required|numeric',
          'country_code'    => 'required',
          'city_id'         => 'required',
        ];
    }

    public function messages()
    {
        return $this->areaRepository->messages();
    }
}
