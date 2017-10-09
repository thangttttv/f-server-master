<?php
namespace App\Http\Responses\API\V1;

class TrackingLog extends Response
{
    protected $columns = [
        'id'                        => '',
        'date'                      => '',
        'campaign_id'               => 0,
        'distance'                  => 0,
        'revenue'                   => 0,
        'revenueCurrencyCode'       => '',
        'trajectory'                => null,
    ];

    /**
     * @param \App\Models\DynamoDB\TrackingLog $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                    => $model->id,
                'date'                  => $model->date,
                'campaign_id'           => $model->campaign_id,
                'distance'              => $model->distance,
                'revenue'               => $model->revenue,
                'revenueCurrencyCode'   => $model->revenue_currency_code,
                'trajectory'            => $model->trajectory,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
