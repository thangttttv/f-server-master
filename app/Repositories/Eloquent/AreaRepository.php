<?php
namespace App\Repositories\Eloquent;

use App\Models\Area;
use App\Repositories\AreaRepositoryInterface;

/**
 * @method \App\Models\Area[] getEmptyList()
 * @method \App\Models\Area[]|\Traversable|array all($order = null, $direction = null)
 * @method \App\Models\Area[]|\Traversable|array get($order, $direction, $offset, $limit)
 * @method \App\Models\Area create($value)
 * @method \App\Models\Area find($id)
 * @method \App\Models\Area[]|\Traversable|array allByIds($ids, $order = null, $direction = null, $reorder = false)
 * @method \App\Models\Area[]|\Traversable|array getByIds($ids, $order = null, $direction = null, $offset = null, $limit = null);
 * @method \App\Models\Area update($model, $input)
 * @method \App\Models\Area save($model);
 */
class AreaRepository extends SingleKeyModelRepository implements AreaRepositoryInterface
{
    /**
     * @return Area
     */
    public function getBlankModel()
    {
        return new Area();
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

    /**
     * @param string $nameLocal
     * @param string $nameEn
     * @param string $countryCode
     * @param string $order
     * @param string $direction
     * @param int    $offset
     * @param int    $limit
     *
     * @return \App\Models\Base[]|\Traversable|array
     */
    public function getEnabledWithConditions($nameLocal, $nameEn, $countryCode, $cityId, $order, $direction, $offset, $limit)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($nameLocal, $nameEn, $countryCode, $cityId, $query);

        return $query->offset($offset)->limit($limit)->orderBy($order, $direction)->get();
    }

    /**
     * @param string $nameLocal
     * @param string $nameEn
     * @param string $countryCode
     *
     * @return int
     */
    public function countEnabledWithConditions($nameLocal, $nameEn, $countryCode, $cityId)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($nameLocal, $nameEn, $countryCode, $cityId, $query);

        return $query->count();
    }

    /**
     * @param string                             $nameLocal
     * @param string                             $nameEn
     * @param string                             $countryCode
     * @param \Illuminate\Database\Query\Builder $query
     *
     * @return \Illuminate\Database\Query\Builder
     */
    private function setSearchQuery($nameLocal, $nameEn, $countryCode, $cityId, $query)
    {
        if (!empty($nameLocal)) {
            $query = $query->where(function ($subquery) use ($nameLocal) {
                $subquery->where('name_local', 'like', '%'.$nameLocal.'%');
            });
        }
        if (!empty($nameEn)) {
            $query = $query->where(function ($subquery) use ($nameEn) {
                $subquery->where('name_en', 'like', '%'.$nameEn.'%');
            });
        }
        if (!empty($countryCode)) {
            $query = $query->where(function ($subquery) use ($countryCode) {
                $subquery->where('country_code', 'like', '%'.$countryCode.'%');
            });
        }
        if (!empty($cityId)) {
            $query = $query->where(function ($subquery) use ($cityId) {
                $subquery->where('city_id', $cityId);
            });
        }

        return $query;
    }
}
