<?php
namespace App\Http\Requests\API\V1;

class ProfileUpdateRequest extends Request
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
            'first_name'        => 'required',
            'last_name'         => 'required',
            'phone_number'      => 'required',
            'date_of_birth'     => 'required|date_format:Y-m-d|before:today',
            'main_area_id'      => 'required',
            'city_id'           => 'required',
            'country_code'      => 'required',
            'profile_image'     => 'image',

        ];
    }

    public function messages()
    {
        return [
            'first_name.required'       => config('api.validateErrors.required'),
            'last_name.required'        => config('api.validateErrors.required'),
            'phone_number.required'     => config('api.validateErrors.required'),
            'date_of_birth.required'    => config('api.validateErrors.required'),
            'main_area_id.required'     => config('api.validateErrors.required'),
            'date_of_birth.date_format' => config('api.validateErrors.dateFormat'),
            'date_of_birth.before'      => config('api.validateErrors.before'),
            'city_id.required'          => config('api.validateErrors.required'),
            'country_code.required'     => config('api.validateErrors.required'),
            'profile_image.image'       => config('api.validateErrors.image'),
        ];
    }
}
