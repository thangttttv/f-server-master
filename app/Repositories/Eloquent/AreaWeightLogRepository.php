<?php
namespace App\Repositories\Eloquent;

use App\Models\AreaWeightLog;
use App\Repositories\AreaWeightLogRepositoryInterface;

/**
 * @method \App\Models\AreaWeightLog[] getEmptyList()
 * @method \App\Models\AreaWeightLog[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\AreaWeightLog[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\AreaWeightLog create($value)
 * @method \App\Models\AreaWeightLog find($id)
 * @method \App\Models\AreaWeightLog[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\AreaWeightLog[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\AreaWeightLog update($model, $input)
 * @method \App\Models\AreaWeightLog save($model);
 */
class AreaWeightLogRepository extends SingleKeyModelRepository implements AreaWeightLogRepositoryInterface
{
    public function getBlankModel()
    {
        return new AreaWeightLog();
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

    public function findActiveWeightLog($areaId, $activeTo, $dayOfWeek, $runTime)
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

        if (!empty($activeTo)) {
            $query = $query->where(function ($subquery) use ($activeTo) {
                $subquery->where('active_to', '<', $activeTo);
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
