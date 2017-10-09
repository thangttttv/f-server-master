<?php
namespace App\Http\Responses\API\V1;

class Campaigns extends ListBase
{
    protected static $itemsResponseModel = Campaign::class;
    /** @var string $itemsColumnName */
    protected $itemsColumnName    = 'campaigns';

    /**
     * @param \App\Models\Base $models
     * @param int              $offset
     * @param int              $limit
     * @param bool             $hasNext
     *
     * @return static
     */
    public static function updateListWithModel($models, $offset = 0, $limit = 10, $hasNext = false)
    {
        $response = new static([], 400);
        $items    = [];
        foreach ($models as $model) {
            $items[] = ((static::$itemsResponseModel)::updateWithModel($model))->toArray();
        }
        $response = new static([
            'hasNext' => $hasNext,
            'offset'  => $offset,
            'limit'   => $limit,
            'items'   => $items,
        ], 200);

        return $response;
    }
}
