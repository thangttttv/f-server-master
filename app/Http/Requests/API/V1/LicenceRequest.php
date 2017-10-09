<?php
/**
 * Created by PhpStorm.
 * User: ironh
 * Date: 4/26/2017
 * Time: 10:31 AM.
 */
namespace App\Http\Requests\API\V1;

class LicenceRequest extends Request
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
            'licence_image' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'licence_image.required'     => config('api.validateErrors.required'),
            'licence_image.image'        => config('api.validateErrors.image'),
        ];
    }
}
