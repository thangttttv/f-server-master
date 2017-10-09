<?php
namespace App\Http\Requests\API\V1;

class CarRequest extends Request
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
            'car_image' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'car_image.required'     => config('api.validateErrors.required'),
            'car_image.image'        => config('api.validateErrors.image'),
        ];
    }
}
