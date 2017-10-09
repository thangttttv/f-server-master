<?php
namespace App\Repositories\Eloquent;

use App\Models\Country;
use App\Repositories\CountryRepositoryInterface;

class CountryRepository extends SingleKeyModelRepository implements CountryRepositoryInterface
{
    public function getBlankModel()
    {
        return new Country();
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
     * @return mixed
     */
    public function getEnabledWithConditions($nameLocal, $nameEn, $countryCode, $order, $direction, $offset, $limit)
    {
        $query = $this->getBlankModel();
        $query = $this->setSearchQuery($nameLocal, $nameEn, $countryCode, $query);

        return $query->offset($offset)->limit($limit)->orderBy($order, $direction)->get();
    }

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
                $subquery->where('code', 'like', '%'.$countryCode.'%');
            });
        }

        return $query;
    }
}
