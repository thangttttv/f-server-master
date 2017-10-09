<?php
namespace App\Http\Responses\API\V1;

class CampaignImages extends ListBase
{
    protected static $itemsResponseModel = CampaignImage::class;
    /** @var string $itemsColumnName */
    protected $itemsColumnName = 'campaign_images';

    protected $columns = [
        'items' => [],
    ];

    public static function updateListAllWithModel($models)
    {
        $items = [];
        foreach ($models as $model) {
            $items[] = (static::$itemsResponseModel)::updateWithModel($model)->toArray();
        }
        $response = new static([
            'items' => $items,
        ], 200);

        return $response;
    }
}
