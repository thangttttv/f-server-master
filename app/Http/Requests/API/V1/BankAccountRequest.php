<?php
namespace App\Http\Requests\API\V1;

class BankAccountRequest extends Request
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
            'bank_id'      => 'required|exists:banks,id',
            'branch_name'  => 'required',
            'owner_name'   => 'required',
            'account_info' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'bank_id.required'             => config('api.validateErrors.required'),
            'branch_name.required'         => config('api.validateErrors.required'),
            'owner_name.required'          => config('api.validateErrors.required'),
            'account_info.required'        => config('api.validateErrors.required'),
            'bank_id.exists'               => config('api.validateErrors.exists'),
        ];
    }
}
