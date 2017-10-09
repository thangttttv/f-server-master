<?php
namespace App\Repositories\DynamoDB\Eloquent;

use App\Models\DynamoDB\TrackingLog;
use App\Repositories\DynamoDB\TrackingLogRepositoryInterface;

class TrackingLogRepository extends SingleKeyModelRepository implements TrackingLogRepositoryInterface
{
    /**
     * @return TrackingLog
     */
    public function getBlankModel()
    {
        return new TrackingLog();
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
}
