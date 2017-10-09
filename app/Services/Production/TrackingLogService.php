<?php
namespace App\Services\Production;

use App\Models\CampaignUser;
use App\Repositories\AreaWeightLogRepositoryInterface;
use App\Repositories\AreaWeightRepositoryInterface;
use App\Repositories\CampaignUserRepositoryInterface;
use App\Repositories\CurrentLocationRepositoryInterface;
use App\Services\TrackingLogServiceInterface;
use Carbon\Carbon;
use Webpatser\Uuid\Uuid;

class TrackingLogService extends BaseService implements TrackingLogServiceInterface
{
    /** @var \App\Repositories\AreaWeightLogRepositoryInterface $areaWeightLogRepository */
    protected $areaWeightLogRepository;

    /** @var \App\Repositories\AreaWeightRepositoryInterface $areaWeightRepository */
    protected $areaWeightRepository;

    /** @var \App\Repositories\CurrentLocationRepositoryInterface $currentLocationRepository */
    protected $currentLocationRepository;

    /** @var \App\Repositories\CampaignUserRepositoryInterface $campaignUserRepository */
    protected $campaignUserRepository;

    public function __construct(
        AreaWeightLogRepositoryInterface $areaWeightLogRepository,
        AreaWeightRepositoryInterface $areaWeightRepository,
        CurrentLocationRepositoryInterface $currentLocationRepository,
        CampaignUserRepositoryInterface $campaignUserRepository
    )
    {
        $this->areaWeightLogRepository      = $areaWeightLogRepository;
        $this->areaWeightRepository         = $areaWeightRepository;
        $this->currentLocationRepository    = $currentLocationRepository;
        $this->campaignUserRepository       = $campaignUserRepository;
    }

    public function countDistance($journey, $areaLocations)
    {
        $areaLocations = json_decode($areaLocations);
        if (count($areaLocations) < 3) {
            return 0;
        }

        $total = 0;
        $displacement = null;
        $prevInside = $this->isInsidePolygon($journey[0], $areaLocations);
        $currInside = null;

        for ($i = 1; $i < count($journey); $i++) {
            $currInside = $this->isInsidePolygon($journey[ $i ], $areaLocations);
            if ($prevInside || $currInside) {
                $displacement = $this->earthDistance(
                    $journey[ $i ]['lat'], $journey[ $i ]['lng'],
                    $journey[ $i - 1 ]['lat'], $journey[ $i - 1 ]['lng']
                );
                if($displacement < 1){
                    $total += $displacement;
                }
            }
            $prevInside = $currInside;
        }

        return $total;
    }

    private function isInsidePolygon($point, $polygon)
    {
        $intersectedEdge = 0;
        $x1 = null;
        $y1 = null;
        $x2 = null;
        $y2 = null;
        $xp = $point['lng'];
        $yp = $point['lat'];
        $i = null;
        for ($i = 0; $i < count($polygon); $i++) {
            $x1 = $polygon[ $i - 1 ]->lng;
            $y1 = $polygon[ $i - 1 ]->lat;
            $x2 = $polygon[ $i ]->lng;
            $y2 = $polygon[ $i ]->lat;

            if ($this->upwardVerticalRayIntersect($x1, $y1, $x2, $y2, $xp, $yp)) {
                $intersectedEdge++;
            }
        }
        $x1 = $x2;
        $y1 = $y2;
        $x2 = $polygon[0]->lng;
        $y2 = $polygon[0]->lat;
        if ($this->upwardVerticalRayIntersect($x1, $y1, $x2, $y2, $xp, $yp)) {
            $intersectedEdge++;
        }

        return $intersectedEdge % 2 == 1;
    }

    private function upwardVerticalRayIntersect($x1, $y1, $x2, $y2, $xp, $yp)
    {
        if ($x1 > $x2) {
            $isBetween = ($xp <= $x1 && $xp >= $x2);
            if (!$isBetween) return false;
            $isUnder = ($y2 + ($xp - $x2) * ($x1 - $x2) / ($y1 - $y2)) > $yp;
        } else {
            $isBetween = ($xp >= $x1 && $xp <= $x2);
            if (!$isBetween) return false;
            $isUnder = ($y1 + ($xp - $x1) * ($x1 - $x2) / ($y1 - $y2)) > $yp;
        }
        return $isUnder;
    }

    private function earthDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadiusKm = 6371;
        $dLat = ($lat2 - $lat1) * M_PI / 180;
        $dLng = ($lng2 - $lng1) * M_PI / 180;
        $lat1 = ($lat1) * M_PI / 180;
        $lat2 = ($lat2) * M_PI / 180;
        $a = sin($dLat / 2) * sin($dLat / 2) + sin($dLng / 2) * sin($dLng / 2) * cos($lat1) * cos($lat2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadiusKm * $c;
    }

    public function createId()
    {
        return Uuid::generate()->string;
    }

    public function hashTrajectory($content)
    {
        return md5('flare' . $content);
    }

    public function calculatorImpression($distance, $areaId, $date, $journey)
    {
        $impression = 0;
        if (count($journey) > 0) {
            $timeRecord = $journey[0]['time'];
            $timeRecord = Carbon::createFromTimestamp($timeRecord);
            $dayOfWeek = $timeRecord->dayOfWeek;
            $hour = $timeRecord->hour;
            $weight = config('area_weight.default_data.weight_hour.' . $hour);
            $areaWeightLog = $this->areaWeightLogRepository->findActiveWeightLog($areaId, $timeRecord, $dayOfWeek, $hour * 60);

            if (!empty($areaWeightLog)) {
                $weight = $areaWeightLog->weight;
            } else {
                $areWeight = $this->areaWeightRepository->findActiveWeight($areaId, $dayOfWeek, $hour * 60);
                if (!empty($areWeight)) {
                    $weight = $areWeight->weight;
                }
            }
            $impression = $distance * $weight;
        }

        return $impression;
    }

    public function getCampaignAreaLocations($campaign)
    {
        $areaLocationData = [];
        if (!empty($campaign) && sizeof($campaign->areas) > 0) {
            foreach ($campaign->areas as $areaKey => $area) {
                $areaLocationData[] = json_decode($area->location_data);
            }
        }
        return $areaLocationData;
    }

    public function getCampaignUserLocations($campaignId)
    {
        $allCampaignUser = $this->campaignUserRepository->AllEnabledWithConditions(
            $userId = 0, $campaignId, $status = '',
            $statusIncluded = [CampaignUser::TYPE_STATUS_FINISHED, CampaignUser::TYPE_STATUS_ONGOING], []);
        $userLocations = [];
        foreach ($allCampaignUser as $key => $campaignUser) {
            $currentLocation = $this->currentLocationRepository->findByUserIdAndCampaignId(
                $campaignUser->user_id, $campaignUser->campaign_id);
            if (!empty($currentLocation)) {
                $userLocations[] = [
                    'lat'  => $currentLocation->latitude,
                    'lng'  => $currentLocation->longitude,
                    'time' => $currentLocation->updated_at->format('Y-m-d H:i'),
                ];
            }
        }
        return $userLocations;
    }
}
