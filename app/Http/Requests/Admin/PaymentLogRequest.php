<?php
namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\PaymentLogRepositoryInterface;

class PaymentLogRequest extends BaseRequest
{
    /** @var \App\Repositories\PaymentLogRepositoryInterface */
    protected $paymentLogRepository;

    public function __construct(PaymentLogRepositoryInterface $paymentLogRepository)
    {
        $this->paymentLogRepository = $paymentLogRepository;
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
            'user_id'         => 'required',
            'bank_account_id' => 'required',
            'status'          => 'required',
            'paid_amount'     => 'required',
            'paid_for_month'  => 'required',
            'currency_code'   => 'required',
            'paid_at'         => 'required',
        ];
    }

    public function messages()
    {
        return $this->paymentLogRepository->messages();
    }
}
