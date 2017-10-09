<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\AreaWeightLogRepositoryInterface;

class AreaWeightLogRequest extends BaseRequest
{
    /** @var \App\Repositories\AreaWeightLogRepositoryInterface */
    protected $areaWeightLogRepository;

    public function __construct(AreaWeightLogRepositoryInterface $areaWeightLogRepository)
    {
        $this->areaWeightLogRepository = $areaWeightLogRepository;
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
        return $this->areaWeightLogRepository->rules();
    }

    public function messages()
    {
        return $this->areaWeightLogRepository->messages();
    }
}
