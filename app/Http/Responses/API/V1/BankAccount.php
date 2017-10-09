<?php
namespace App\Http\Responses\API\V1;

class BankAccount extends Response
{
    protected $columns = [
        'id'          => 0,
        'user'        => null,
        'bank'        => null,
        'branchName'  => '',
        'ownerName'   => '',
        'accountInfo' => '',
    ];

    /**
     * @param \App\Models\BankAccount $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $bankModel = Bank::updateWithModel($model->bank)->toArray();
            $bank      = null;
            if (!empty($bankModel)) {
                $bank = $bankModel;
            }
            $modelArray = [
                'id'          => $model->id,
                'bank'        => $bank,
                'branchName'  => $model->branch_name,
                'ownerName'   => $model->owner_name,
                'accountInfo' => $model->account_info,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
