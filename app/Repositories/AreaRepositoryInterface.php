<?php
namespace App\Repositories;

interface AreaRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @param string $nameLocal
     * @param string $nameEn
     * @param string $countryCode
     * @param int    $cityId
     * @param string $order
     * @param string $direction
     * @param int    $offset
     * @param int    $limit
     *
     * @return \App\Models\Base[]|\Traversable|array
     */
    public function getEnabledWithConditions($nameLocal, $nameEn, $countryCode, $cityId, $order, $direction, $offset, $limit);

    /**
     * @param string $nameLocal
     * @param string $nameEn
     * @param string $countryCode
     * @param int    $cityId
     *
     * @return int
     */
    public function countEnabledWithConditions($nameLocal, $nameEn, $countryCode, $cityId);
}
