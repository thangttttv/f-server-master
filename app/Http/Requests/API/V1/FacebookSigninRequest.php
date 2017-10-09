<?php
namespace App\Http\Requests\API\V1;

class FacebookSigninRequest extends Request
{
    public function rules()
    {
        return [
            'fb_token' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'fb_token.required' => config('api.validateErrors.required'),
        ];
    }
}
