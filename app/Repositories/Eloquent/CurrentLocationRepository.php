<?php
namespace App\Repositories\Eloquent;

use App\Models\CurrentLocation;
use App\Repositories\CurrentLocationRepositoryInterface;

/**
 * @method \App\Models\CurrentLocation[] getEmptyList()
 * @method \App\Models\CurrentLocation[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\CurrentLocation[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\CurrentLocation create($value)
 * @method \App\Models\CurrentLocation find($id)
 * @method \App\Models\CurrentLocation[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\CurrentLocation[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\CurrentLocation update($model, $input)
 * @method \App\Models\CurrentLocation save($model);
 */
class CurrentLocationRepository extends SingleKeyModelRepository implements CurrentLocationRepositoryInterface
{
    public function getBlankModel()
    {
        return new CurrentLocation();
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
