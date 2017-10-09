<?php
namespace App\Http\Requests\Advertiser;

use App\Http\Requests\BaseRequest;
use App\Repositories\CampaignRepositoryInterface;

class CampaignRequest extends BaseRequest
{
    /** @var \App\Repositories\CampaignRepositoryInterface */
    protected $campaignRepository;

    public function __construct(CampaignRepositoryInterface $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
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
            'budget'   => 'required',
            'date'     => 'required',
        ];
    }

    public function messages()
    {
        return $this->campaignRepository->messages();
    }
}
