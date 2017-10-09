<?php
namespace App\Http\Requests\API\V1;

class CampaignApplyRequest extends Request
{
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
            'campaign_image_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'campaign_image_id.required'    => config('api.validateErrors.required'),
        ];
    }
}
