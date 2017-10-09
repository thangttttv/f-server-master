<?php
namespace App\Repositories\Eloquent;

use App\Models\AreaWeight;
use App\Repositories\AreaWeightRepositoryInterface;

/**
 * @method \App\Models\AreaWeight[] getEmptyList()
 * @method \App\Models\AreaWeight[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\AreaWeight[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\AreaWeight create($value)
 * @method \App\Models\AreaWeight find($id)
 * @method \App\Models\AreaWeight[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\AreaWeight[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\AreaWeight update($model, $input)
 * @method \App\Models\AreaWeight save($model);
 */
class AreaWeightRepository extends SingleKeyModelRepository implements AreaWeightRepositoryInterface
{
    public function getBlankModel()
    {
        return new AreaWeight();
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

    public function findActiveWeight($areaId, $dayOfWeek, $runTime)
    {
        $query = $this->getBlankModel();
        if (!empty($areaId)) {
            $query = $query->where(function ($subquery) use ($areaId) {
                $subquery->where('area_id', $areaId);
            });
        }
        if (!empty($dayOfWeek)) {
            $query = $query->where(function ($subquery) use ($dayOfWeek) {
                $subquery->where('day_of_week', $dayOfWeek);
            });
        }

        if (!empty($runTime)) {
            $query = $query->where(function ($subquery) use ($runTime) {
                $subquery->where('start_time', '<', $runTime);
            });
            $query = $query->where(function ($subquery) use ($runTime) {
                $subquery->where('end_time', '>', $runTime);
            });
        }

        return $query->first();
    }
}
