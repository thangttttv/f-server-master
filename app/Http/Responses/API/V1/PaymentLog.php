<?php
namespace App\Http\Responses\API\V1;

class PaymentLog extends Response
{
    protected $columns = [
        'id'           => 0,
        'bankAccount'  => null,
        'paidAmount'   => 0,
        'paidForMonth' => '',
        'currencyCode' => '',
        'paidAt'       => '',
        'note'         => '',
        'status'       => '',
    ];

    /**
     * @param \App\Models\PaymentLog $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $bankAccountModel = BankAccount::updateWithModel($model->bankAccount)->toArray();
            $bankAccount      = null;
            if (!empty($bankAccountModel)) {
                $bankAccount = $bankAccountModel;
            }
            $modelArray = [
                'id'           => $model->id,
                'bankAccount'  => $bankAccount,
                'paidAmount'   => $model->paid_amount,
                'paidForMonth' => $model->paid_for_month,
                'currencyCode' => $model->currency_code,
                'paidAt'       => $model->paid_at,
                'note'         => $model->note,
                'status'       => $model->status,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
