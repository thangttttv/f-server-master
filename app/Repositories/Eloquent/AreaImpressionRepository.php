<?php
namespace App\Repositories\Eloquent;

use App\Models\AreaImpression;
use App\Repositories\AreaImpressionRepositoryInterface;

/**
 * @method \App\Models\AreaImpression[] getEmptyList()
 * @method \App\Models\AreaImpression[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\AreaImpression[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\AreaImpression create($value)
 * @method \App\Models\AreaImpression find($id)
 * @method \App\Models\AreaImpression[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\AreaImpression[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\AreaImpression update($model, $input)
 * @method \App\Models\AreaImpression save($model);
 */
class AreaImpressionRepository extends SingleKeyModelRepository implements AreaImpressionRepositoryInterface
{
    public function getBlankModel()
    {
        return new AreaImpression();
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
