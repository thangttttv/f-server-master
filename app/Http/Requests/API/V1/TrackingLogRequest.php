<?php
namespace App\Http\Requests\API\V1;

class TrackingLogRequest extends Request
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
            'trajectory'        => 'required',
            'campaign_id'       => 'required',
            'date'              => 'required|date',
            'id'                => 'required',
            'trajectory_hash'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id.required'               => config('api.validateErrors.required'),
            'trajectory.required'       => config('api.validateErrors.required'),
            'campaign_id.required'      => config('api.validateErrors.required'),
            'date.required'             => config('api.validateErrors.required'),
            'date.date'                 => config('api.validateErrors.date'),
        ];
    }
}
