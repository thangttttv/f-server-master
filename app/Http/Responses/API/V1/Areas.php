<?php
namespace App\Http\Responses\API\V1;

class Areas extends ListBase
{
    protected static $itemsResponseModel = Area::class;
    /** @var string $itemsColumnName */
    protected $itemsColumnName = 'areas';

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
