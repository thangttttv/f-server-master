<?php
namespace App\Http\Responses\API\V1;

class CampaignImage extends Response
{
    protected $columns = [
        'id'                    => 0,
        'url'                   => '',
        'baseRevenue'           => '',
        'currencyCode'          => '',
        'imageType'             => '',
    ];

    /**
     * @param \App\Models\CampaignImage $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'           => $model->id,
                'url'          => $model->present()->getWrappingImageUrl(),
                'baseRevenue'  => $model->base_revenue,
                'currencyCode' => $model->currency_code,
                'imageType'    => $model->image_type,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
