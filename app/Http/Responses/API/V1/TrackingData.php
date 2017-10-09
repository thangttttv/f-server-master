<?php
namespace App\Http\Responses\API\V1;

class TrackingData extends Response
{
    protected $columns = [
        'totalDistance' => 0,
        'totalEarning'  => 0,
        'currencyCode'  => '',
    ];

    /**
     * @param \App\Models\UserDistance $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model) && !empty($model->id)) {
            $modelArray = [
                'totalDistance' => floatval($model->totalDistance),
                'totalEarning'  => floatval($model->totalEarning),
                'currencyCode'  => strtoupper($model->campaign->budget_currency_code),
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
