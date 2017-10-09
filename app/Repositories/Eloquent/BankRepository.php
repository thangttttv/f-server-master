<?php
namespace App\Repositories\Eloquent;

use App\Models\Bank;
use App\Repositories\BankRepositoryInterface;

/**
 * @method \App\Models\Bank[] getEmptyList()
 * @method \App\Models\Bank[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Bank[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Bank create($value)
 * @method \App\Models\Bank find($id)
 * @method \App\Models\Bank[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Bank[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Bank update($model, $input)
 * @method \App\Models\Bank save($model);
 */
class BankRepository extends SingleKeyModelRepository implements BankRepositoryInterface
{
    public function getBlankModel()
    {
        return new Bank();
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
