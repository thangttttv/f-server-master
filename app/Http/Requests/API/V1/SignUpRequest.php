<?php
namespace App\Http\Requests\API\V1;

class SignUpRequest extends Request
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
            'email'         => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
            'password'      => 'required|min:6',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone_number'  => 'required',
            'country_code'  => 'required',
            'city_id'       => 'required',
            'grant_type'    => 'required',
            'client_id'     => 'required',
            'client_secret' => 'required',
            'date_of_birth' => 'required|date_format:Y-m-d|before:today',
            'main_area_id'  => 'required',
            'scope'         => '',

        ];
    }

    public function messages()
    {
        return [
            'email.required'            => config('api.validateErrors.required'),
            'email.email'               => config('api.validateErrors.email'),
            'email.unique'              => config('api.validateErrors.unique'),
            'password.required'         => config('api.validateErrors.required'),
            'first_name.required'       => config('api.validateErrors.required'),
            'last_name.required'        => config('api.validateErrors.required'),
            'phone_number.required'     => config('api.validateErrors.required'),
            'country_code.required'     => config('api.validateErrors.required'),
            'city_id.required'          => config('api.validateErrors.required'),
            'grant_type.required'       => config('api.validateErrors.required'),
            'client_id.required'        => config('api.validateErrors.required'),
            'client_secret.required'    => config('api.validateErrors.required'),
            'date_of_birth.required'    => config('api.validateErrors.required'),
            'date_of_birth.date_format' => config('api.validateErrors.date_format'),
            'date_of_birth.before'      => config('api.validateErrors.before'),
            'scope.required'            => config('api.validateErrors.required'),
            'main_area_id.required'     => config('api.validateErrors.required'),
        ];
    }
}
