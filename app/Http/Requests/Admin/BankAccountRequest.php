<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\BankAccountRepositoryInterface;

class BankAccountRequest extends BaseRequest
{
    /** @var \App\Repositories\BankAccountRepositoryInterface */
    protected $bankAccountRepository;

    public function __construct(BankAccountRepositoryInterface $bankAccountRepository)
    {
        $this->bankAccountRepository = $bankAccountRepository;
    }

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
            'owner_name'        => 'required',
            'account_info'      => 'required',
            'branch_name'       => 'required',
            'user_id'           => 'required',
            'bank_id'           => 'required',
        ];
    }

    public function messages()
    {
        return $this->bankAccountRepository->messages();
    }
}
