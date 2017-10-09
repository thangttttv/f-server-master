<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\CampaignImageRepositoryInterface;

class CampaignImageRequest extends BaseRequest
{
    /** @var \App\Repositories\CampaignImageRepositoryInterface */
    protected $campaignImageRepository;

    public function __construct(CampaignImageRepositoryInterface $campaignImageRepository)
    {
        $this->campaignImageRepository = $campaignImageRepository;
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
            'base_revenue'  => 'required',
            'campaign_id'   => 'required',
            'currency_code' => 'required',
            'image_type'    => 'required',
        ];
    }

    public function messages()
    {
        return $this->campaignImageRepository->messages();
    }
}
