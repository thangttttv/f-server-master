<?php
namespace App\Repositories\Eloquent;

use App\Models\BankAccount;
use App\Repositories\BankAccountRepositoryInterface;

/**
 * @method \App\Models\BankAccount[] getEmptyList()
 * @method \App\Models\BankAccount[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\BankAccount[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\BankAccount create($value)
 * @method \App\Models\BankAccount find($id)
 * @method \App\Models\BankAccount[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\BankAccount[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\BankAccount update($model, $input)
 * @method \App\Models\BankAccount save($model);
 */
class BankAccountRepository extends SingleKeyModelRepository implements BankAccountRepositoryInterface
{
    public function getBlankModel()
    {
        return new BankAccount();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
