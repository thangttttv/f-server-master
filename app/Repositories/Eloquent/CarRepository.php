<?php
namespace App\Repositories\Eloquent;

use App\Models\Car;
use App\Repositories\CarRepositoryInterface;

/**
 * @method \App\Models\Car[] getEmptyList()
 * @method \App\Models\Car[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Car[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Car create($value)
 * @method \App\Models\Car find($id)
 * @method \App\Models\Car[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Car[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Car update($model, $input)
 * @method \App\Models\Car save($model);
 */
class CarRepository extends SingleKeyModelRepository implements CarRepositoryInterface
{
    public function getBlankModel()
    {
        return new Car();
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
