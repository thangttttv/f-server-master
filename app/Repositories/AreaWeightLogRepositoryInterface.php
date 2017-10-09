<?php
namespace App\Repositories;

use Carbon\Carbon;

interface AreaWeightLogRepositoryInterface extends SingleKeyModelRepositoryInterface
{
    /**
     * @param int    $areaId
     * @param Carbon $activeTo
     * @param int    $dayOfWeek
     * @param int    $runTime
     *
     * @return mixed
     */
    public function findActiveWeightLog($areaId, $activeTo, $dayOfWeek, $runTime);
}
