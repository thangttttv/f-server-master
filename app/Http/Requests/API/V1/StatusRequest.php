<?php
namespace App\Http\Requests\API\V1;

class StatusRequest extends Request
{
    public function rules()
    {
        return [
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'status.required' => trans('validation.required'),
        ];
    }
}
