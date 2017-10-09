<?php
/**
 * Created by PhpStorm.
 * User: ironh
 * Date: 5/9/2017
 * Time: 3:38 PM.
 */
namespace App\Http\Requests\API\V1;

class ProfileImageUpdateRequest extends Request
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
            'profile_image'     => 'required|image',

        ];
    }

    public function messages()
    {
        return [
            'profile_image.required'    => config('api.validateErrors.required'),
            'profile_image.image'       => config('api.validateErrors.image'),
        ];
    }
}
