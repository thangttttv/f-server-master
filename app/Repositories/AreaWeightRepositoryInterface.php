<?php
namespace App\Repositories;

interface AreaWeightRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @param int $areaId
     * @param int $dayOfWeek
     * @param int $runTime
     *
     * @return mixed
     */
    public function findActiveWeight($areaId, $dayOfWeek, $runTime);
}
