<?php
namespace App\Http\Requests\API\V1;

class MessageImageRequest extends Request
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
            'message_image'     => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'message_image.required'    => config('api.validateErrors.required'),
            'message_image.image'       => config('api.validateErrors.image'),
        ];
    }
}
