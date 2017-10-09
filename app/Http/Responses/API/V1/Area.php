<?php
namespace App\Http\Responses\API\V1;

class Area extends Response
{
    protected $columns = [
        'id'                    => 0,
        'nameEn'                => '',
        'nameLocal'             => '',
        'city'                  => null,
        'order'                 => 0,
        'locationData'          => null,
    ];

    /**
     * @param \App\Models\Area $model
     *
     * @return static
     */
    public static function updateWithModel($model)
    {
        $response = new static([], 400);
        if (!empty($model)) {
            $modelArray = [
                'id'                => $model->id,
                'nameEn'            => $model->name_en,
                'nameLocal'         => $model->name_local,
                'city'              => (City::updateWithModel($model->city))->toArray(),
                'locationData'      => $model->location_data,
                'order'             => $model->order,
            ];
            $response = new static($modelArray, 200);
        }

        return $response;
    }
}
