<?php
namespace App\Repositories\Eloquent;

use App\Models\Area;
use App\Models\Campaign;
use App\Repositories\CampaignRepositoryInterface;

/**
 * @method \App\Models\Campaign[] getEmptyList()
 * @method \App\Models\Campaign[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Campaign[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Campaign create($value)
 * @method \App\Models\Campaign find($id)
 * @method \App\Models\Campaign[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Campaign[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Campaign update($model, $input)
 * @method \App\Models\Campaign save($model);
 */
class CampaignRepository extends SingleKeyModelRepository implements CampaignRepositoryInterface
{
    public function getBlankModel()
    {
        return new Campaign();
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

    public function getEnabledWithConditions($advertiserId, $countryCode, $cityId, $areaIds, $name,
                                             $runningOnly = false, $status = '', $order = 'id', $direction = 'asc', $offset = 0, $limit = 10)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($advertiserId, $countryCode, $cityId, $areaIds, $name, $runningOnly, $status, $query);

        return $query->offset($offset)->limit($limit)->orderBy($order, $direction)->get();
    }

    public function countEnabledWithConditions($advertiserId, $countryCode, $cityId, $areaIds, $name, $runningOnly = false, $status = '')
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($advertiserId, $countryCode, $cityId, $areaIds, $name, $runningOnly, $status, $query);

        return $query->count();
    }


    /**
     * @param int $advertiserId
     * @param string $countryCode
     * @param int $cityId
     * @param array $areaIds
     * @param string $name
     * @param boolean $runningOnly
     * @param string $status
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    private function setSearchQuery($advertiserId, $countryCode, $cityId, $areaIds, $name, $runningOnly, $status, $query)
    {
        if (!empty($countryCode)) {
            $query = $query->where(function ($subquery) use ($countryCode) {
                $subquery->where('country_code', $countryCode);
            });
        }
        if (!empty($cityId)) {
            $query = $query->where(function ($subquery) use ($cityId) {
                $subquery->where('city_id', $cityId);
            });
        }
        if (!empty($name)) {
            $query = $query->where(function ($subquery) use ($name) {
                $subquery->where('name', 'like', '%' . $name . '%');
            });
        }
        if (!empty($advertiserId)) {
            $query = $query->where(function ($subquery) use ($advertiserId) {
                $subquery->where('advertiser_id', $advertiserId);
            });
        }
        if (!empty($status)) {
            $query = $query->where(function ($subquery) use ($status) {
                $subquery->where('status', $status);
            });
        }
        if ($runningOnly) {
            $query = $query->where(function ($subquery) use ($runningOnly) {
                $subquery->whereDate('start_date', '<=', \DateTimeHelper::now());
            });
            $query = $query->where(function ($subquery) use ($runningOnly) {
                $subquery->whereDate('end_date', '>', \DateTimeHelper::now());
                $subquery->orWhere(function ($orQuery) {
                    $orQuery->whereNull('end_date');
                });
            });
        }
        if (count($areaIds > 0)) {
            foreach ($areaIds as $areaId) {
                $query = $query->whereHas('areas', function ($subquery) use ($areaId) {
                    $subquery->where(Area::getTableName() . '.id', $areaId);
                });
            }
        }

        return $query;
    }
}
