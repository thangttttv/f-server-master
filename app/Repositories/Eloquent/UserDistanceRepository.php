<?php
namespace App\Repositories\Eloquent;

use App\Models\UserDistance;
use App\Repositories\UserDistanceRepositoryInterface;

/**
 * @method \App\Models\UserDistance[] getEmptyList()
 * @method \App\Models\UserDistance[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\UserDistance[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\UserDistance create($value)
 * @method \App\Models\UserDistance find($id)
 * @method \App\Models\UserDistance[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\UserDistance[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\UserDistance update($model, $input)
 * @method \App\Models\UserDistance save($model);
 */
class UserDistanceRepository extends SingleKeyModelRepository implements UserDistanceRepositoryInterface
{
    protected $totalDistance = 'totalDistance';
    protected $totalEarning  = 'totalEarning';
    protected $totalImpression  = 'totalImpression';

    public function getBlankModel()
    {
        return new UserDistance();
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

    public function sumDistanceUser($userId, $campaignId, $areaId = 0, $date = '', $month='')
    {
        $query = $this->getBlankModel();
        $query = $this->setSumDistanceUser($userId, $campaignId, $areaId, $date, $month, $query);

        return $query->first();
    }

    public function sumDistanceUserGroupByDate($userId, $campaignId, $areaId = 0, $date = '', $month='', $order, $direction)
    {
        $query = $this->getBlankModel();
        $query = $this->setSumDistanceUser($userId, $campaignId, $areaId, $date, $month, $query);
        $query = $query->groupBy('date');

        return $query->orderBy($order, $direction)->get();
    }

    private function setSumDistanceUser($userId, $campaignId, $areaId, $date, $month, $query)
    {
        if (!empty($teacherId)) {
            $query = $query->where(function ($subquery) use ($teacherId) {
                $subquery->where('teacher_id', $teacherId);
            });
        }
        $query = $query->selectRaw($query::getTableName().'.*, sum('.$query::getTableName().'.distance) as '.$this->totalDistance.
            ',sum('.$query::getTableName().'.total_cost) as '.$this->totalEarning .
            ',sum('.$query::getTableName().'.total_impression) as '.$this->totalImpression
        );

        if (!empty($userId)) {
            $query = $query->where(function ($subquery) use ($userId) {
                $subquery->where('user_id', $userId);
            });
        }
        if (!empty($campaignId)) {
            $query = $query->where(function ($subquery) use ($campaignId) {
                $subquery->where('campaign_id', $campaignId);
            });
        }
        if (!empty($date)) {
            $query = $query->where(function ($subquery) use ($date) {
                $subquery->whereDate('date', $date);
            });
        }
        if (!empty($month)) {
            $timeArray = explode('-', $month);
            $month     = $timeArray[1];
            $year      = $timeArray[0];
            $query     = $query->where(function ($subquery) use ($year, $month) {
                $subquery->whereYear('date', $year);
                $subquery->whereMonth('date', $month);
            });
        }

        if (!empty($areaId)) {
            $query = $query->where(function ($subquery) use ($areaId) {
                $subquery->where('area_id', $areaId);
            });
        }

        return $query;
    }
}
