<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\AreaWeightRepositoryInterface;

class AreaWeightRequest extends BaseRequest
{
    /** @var \App\Repositories\AreaWeightRepositoryInterface */
    protected $areaWeightRepository;

    public function __construct(AreaWeightRepositoryInterface $areaWeightRepository)
    {
        $this->areaWeightRepository = $areaWeightRepository;
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
            'area_id'       => 'required',
            'day_of_week'   => 'required|in:1,2,3,4,5,6,7',
            'start_time'    => 'required',
            'end_time'      => 'required',
            'weight'        => 'required',
        ];
    }

    public function messages()
    {
        return $this->areaWeightRepository->messages();
    }
}
