<?php
namespace App\Repositories\Eloquent;

use App\Models\City;
use App\Repositories\CityRepositoryInterface;

class CityRepository extends SingleKeyModelRepository implements CityRepositoryInterface
{
    public function getBlankModel()
    {
        return new City();
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
    public function getEnabledWithConditions($nameLocal, $nameEn, $countryCode, $order, $direction, $offset, $limit)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($nameLocal, $nameEn, $countryCode, $query);

        return $query->offset($offset)->limit($limit)->orderBy($order, $direction)->get();
    }

    /**
     * @param string $nameLocal
     * @param string $nameEn
     * @param string $countryCode
     *
     * @return int
     */
    public function countEnabledWithConditions($nameLocal, $nameEn, $countryCode)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($nameLocal, $nameEn, $countryCode, $query);

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
    private function setSearchQuery($nameLocal, $nameEn, $countryCode, $query)
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

        return $query;
    }
}
