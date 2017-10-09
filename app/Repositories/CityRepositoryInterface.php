<?php
namespace App\Repositories;

interface CityRepositoryInterface extends SingleKeyModelRepositoryInterface
{
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
    public function getEnabledWithConditions($nameLocal, $nameEn, $countryCode, $order, $direction, $offset, $limit);

    /**
     * @param string $nameLocal
     * @param string $nameEn
     * @param string $countryCode
     *
     * @return int
     */
    public function countEnabledWithConditions($nameLocal, $nameEn, $countryCode);
}
