<?php
namespace App\Http\Responses\API\V1;

class Campaign extends Response
{
    protected $columns = [
        'id'                    => 0,
        'name'                  => '',
        'description'           => '',
        'distance'              => 0,
        'minimumRevenue'        => 0,
        'maximumRevenue'        => 0,
        'budgetCurrencyCode'    => '',
        'budget'                => 0,
        'startDate'             => 0,
        'endDate'               => 0,
        'country'               => null,
        'city'                  => null,
        'advertiser'            => null,
        'brandImage'            => null,
        'areas'                 => [],
        'wrappingImages'        => [],
        'minimumRate'           => 0,
        'maximumRate'           => 0,
    ];

    /**
     * @param \App\Models\Base $campaign
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $areas          = (Areas::updateListAllWithModel($model->areas))->data['items'];
            $city           = (City::updateWithModel($model->city))->toArray();
            $wrappingImages = (CampaignImages::updateListAllWithModel($model->wrappingImages))->data['items'];
            $minimumRate    = $model->present()->minimumRate($wrappingImages);
            $maximumRate    = $model->present()->maximumRate($wrappingImages);
            $modelArray     = [
                'id'                 => $model->id,
                'name'               => $model->name,
                'description'        => $model->description,
                'distance'           => $model->distance,
                'minimumRevenue'     => $model->minimum_revenue,
                'maximumRevenue'     => $model->maximum_revenue,
                'budgetCurrencyCode' => $model->budget_currency_code,
                'budget'             => $model->budget,
                'startDate'          => $model->start_date,
                'endDate'            => $model->end_date,
                'country'            => (Country::updateWithModel($model->country))->toArray(),
                'city'               => $city,
                'advertiser'         => (Advertiser::updateWithModel($model->advertiser)),
                'brandImage'         => $model->present()->brandImageUrl(),
                'wrappingImages'     => $wrappingImages,
                'areas'              => $areas,
                'minimumRate'        => $minimumRate,
                'maximumRate'        => $maximumRate,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
