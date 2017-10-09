<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\BankRepositoryInterface;

class BankRequest extends BaseRequest
{
    /** @var \App\Repositories\BankRepositoryInterface */
    protected $bankRepository;

    public function __construct(BankRepositoryInterface $bankRepository)
    {
        $this->bankRepository = $bankRepository;
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
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return $this->bankRepository->messages();
    }
}
